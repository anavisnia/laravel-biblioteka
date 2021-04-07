/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

if (document.querySelector('.book-delete')) {
    document.querySelectorAll('.book-delete').forEach(form => {
        form.addEventListener('submit', e => {
            const answer = confirm('Are you sure?');
            if (answer) {
                return true;
            }
            e.preventDefault();
        });
    })
}