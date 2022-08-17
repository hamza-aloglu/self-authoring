async function validateJWT() {
    const userToken = localStorage.getItem('token');

    let response = await fetch('http://localhost/self-authoring/isValidJWT', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(userToken)
    });
    return await response.json();
}

