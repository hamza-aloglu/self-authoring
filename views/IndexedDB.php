<script>
    if (!(localStorage.getItem('token') != null && localStorage.getItem('uid') != null)) {
        let db;
        const openRequest = window.indexedDB.open('writings_db', 3);
        openRequest.addEventListener('error', () => console.error('Database failed to open'));

        openRequest.addEventListener('success', () => {
            console.log('Database opened successfully');
            db = openRequest.result;
            displayData();
        });

        openRequest.addEventListener('upgradeneeded', (e) => {
            db = e.target.result;
            const objectStore = db.createObjectStore('writings_os', {keyPath: 'id', autoIncrement: true});
            objectStore.createIndex('body', 'body', {unique: false});

            console.log('Database setup complete');
        });

        const writingForm = document.getElementById('create_text');
        writingForm.addEventListener('submit', addData);

        const bodyInput = document.getElementById('text');

        function addData(e) {
            e.preventDefault();

            const newItem = {body: bodyInput.value};
            const transaction = db.transaction(['writings_os'], 'readwrite');
            const objectStore = transaction.objectStore('writings_os');
            const addRequest = objectStore.add(newItem);

            addRequest.addEventListener('success', () => {
                bodyInput.value = '';
            });

            transaction.addEventListener('complete', () => {
                console.log('Transaction completed: database modification finished.');
                displayData();
            });

            transaction.addEventListener('error', () => console.log('Transaction not opened due to error'));
        }

        const list = document.getElementById('list');

        function displayData() {
            // If you didn't do this, you'd get duplicates listed each time a new note is added
            while (list.firstChild) {
                list.removeChild(list.firstChild);
            }

            const objectStore = db.transaction('writings_os').objectStore('writings_os');
            console.log(objectStore);
            objectStore.openCursor().addEventListener('success', (e) => {
                const cursor = e.target.result;

                if (cursor) {
                    const relocateTextButton = document.createElement('button');
                    const listItem = document.createElement('li');
                    const para = document.createElement('p');

                    relocateTextButton.appendChild(para)
                    listItem.appendChild(relocateTextButton);
                    list.appendChild(listItem);

                    const textArea = document.getElementById('text');
                    relocateTextButton.addEventListener('click', function () {
                       textArea.innerText = para.innerText;
                    });


                    para.textContent =  cursor.value.body;
                    // Reason putting id attribute is deletion when delete button clicked.
                    listItem.setAttribute('data-writing-id', cursor.value.id);

                    const deleteBtn = document.createElement('button');
                    listItem.appendChild(deleteBtn);
                    deleteBtn.textContent = 'Delete';

                    deleteBtn.addEventListener('click', deleteItem);

                    cursor.continue();
                } else {
                    if (!list.firstChild) {
                        const listItem = document.createElement('li');
                        listItem.textContent = 'No notes stored.'
                        list.appendChild(listItem);
                    }
                    console.log('Notes all displayed');
                }
            });
        }

        function deleteItem(e) {
            const noteId = Number(e.target.parentNode.getAttribute('data-writing-id'));

            const transaction = db.transaction(['writings_os'], 'readwrite');
            const objectStore = transaction.objectStore('writings_os');
            objectStore.delete(noteId);

            transaction.addEventListener('complete', () => {
                // delete the parent of the button
                // which is the list item, so it is no longer displayed
                e.target.parentNode.parentNode.removeChild(e.target.parentNode);
                console.log(`Note ${noteId} deleted.`);

                if (!list.firstChild) {
                    const listItem = document.createElement('li');
                    listItem.textContent = 'No notes stored.';
                    list.appendChild(listItem);
                }
            });
        }
    }

</script>