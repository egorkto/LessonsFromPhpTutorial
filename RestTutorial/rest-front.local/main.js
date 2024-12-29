let currentId = null;

async function getPosts() {
    let res = await fetch('https://rest-api.local/posts');
    let posts = await res.json();
    console.log(document.querySelector('.post-list'));
    document.querySelector('.post-list').innerHTML = '';
    posts.forEach((post) => {
        document.querySelector('.post-list').innerHTML += `
            <div class="card" styles="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">${post.title}</h5>
                    <p class="card-text">${post.body}</p>
                    <a href="#" class="card-link">More</a>
                    <a href="#" class="card-link" onclick="removePost(${post.id})">Delete</a>
                    <a href="#" class="card-link" onclick="selectPost('${post.id}', '${post.title}', '${post.body}')">Edit</a>        
                </div>
            </div>
        `
    });
}

async function addPost() {
    const title = document.getElementById('title').value,
        body = document.getElementById('body').value;
    let formData = new FormData();
    formData.append('title', title);
    formData.append('body', body);
    const res = await fetch('https://rest-api.local/posts', {
        method: "POST",
        body: formData
    });

    const data = await res.json();
    if(data.status === true) {
        await getPosts();
    }
}

async function removePost(id) {
    const res = await fetch(`https://rest-api.local/posts/${id}`, {
        method: "DELETE"
    });
    const data = await res.json();

    if(data.status === true){
        await getPosts();
    }
}

function selectPost(id, title, body)
{
    currentId = id;
    document.getElementById('title-edit').value = title;
    document.getElementById('body-edit').value = body;
}

async function updatePost()
{
    const postTitle = document.getElementById('title-edit').value;
    const postBody = document.getElementById('body-edit').value;

    const data = {
        title: postTitle,
        body: postBody
    };

    const res = await fetch(`https://rest-api.local/posts/${currentId}`, {
        method: "PATCH",
        body: JSON.stringify(data)
    });

    let resData = await res.json();
    console.log(resData.status);
    if(resData.status === true)
    {
        await getPosts();
    }
}

getPosts();