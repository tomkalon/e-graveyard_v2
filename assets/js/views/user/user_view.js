const getUser= (user) => {
    const div = document.createElement('div');

    div.innerHTML = `
        <p class="text-center">${user.username} | ${user.email}</p>
    `
    return div
}

export { getUser };
