const getUser= (user) => {
    const div = document.createElement('div');

    div.innerHTML = `
        <p class="pl-4 font-bold">${user.username} | ${user.email}</p>
    `
    return div
}

export { getUser };
