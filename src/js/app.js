
document.addEventListener('DOMContentLoaded', darkMode);

function darkMode() {
    const prefDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    applyDarkMode(prefDarkMode.matches);
    prefDarkMode.addEventListener('change', () => {
        applyDarkMode(prefDarkMode.matches);
    });
}

function applyDarkMode(match) {
    if(match) {
        document.body.classList.add('dark-mode');
    }
    else {
        document.body.classList.remove('dark-mode');
    }
}