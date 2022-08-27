async function fetchWritingsOfUser() {
    const uid = localStorage.getItem('uid');
    let response = await fetch('http://localhost/self-authoring/getTexts', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(uid)
    });
    return await response.json();
}