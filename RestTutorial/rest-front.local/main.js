async function getPosts() {
    let res = await fetch('https://jsonplaceholder.typicode.com/posts');
    let posts = await res.json();
    console.log(document.querySelector('.post-list'));
    posts.forEach((post) => {
        document.querySelector('.post-list').innerHTML += `
            <div class="card" styles="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">${post.title}</h5>
                    <p class="card-text">${post.body}</p>
                    <a href="#" class="card-link">More</a>
                </div>
            </div>
        `
    });
}

getPosts();