/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
/*
const deleteConfirm = () => {

    if (document.querySelector('.book-delete')) {

        document.querySelectorAll('.book-delete').forEach(form => {
            form.addEventListener('submit', e => {
                const answer = confirm('Are jū šūre?')

                // document.querySelector('#mod').style.display = 'block';
                // document.querySelector('#mod').innerHTML = "Are ju šure to delete book " + form.dataset.bookId;

                // const answer = false;
                if (answer) {
                    return true;
                }
                e.preventDefault();
            });
        })
    }

    // publishers confirm dialog
    // if (document.querySelector('.pub-delete')) {
    //     document.querySelectorAll('.pub-delete').forEach(form => {
    //         form.addEventListener('submit', e => {
    //             const answer = confirm('Are you sure?')
    //             if (answer) {
    //                 return true;
    //             }
    //             e.preventDefault();
    //         });
    //     })
    // }

}

const displayMsg = (type = '', msg = '') => {
    const info = document.querySelector('#info-msg');
    const success = document.querySelector('#success-msg');
    if (type === 'success') {
        info.style.display = 'none';
        success.style.display = 'block';
        success.innerHTML = msg;
    } else if (type === 'info') {
        success.style.display = 'none';
        info.style.display = 'block';
        info.innerHTML = msg;
    } else {
        success.style.display = 'none';
        info.style.display = 'none';
    }
}


const doBlockLoad = () => {
    /// LOADS
    if (document.querySelector('[data-block-load]')) {
        const container = document.querySelector('[data-block-load]');
        const url = container.dataset.url;
        axios.get(url)
            .then(function (response) {
                container.innerHTML = response.data.html;
                // deleteConfirm();
                doDelete();
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });

    }
}

const doDelete = () => {
    /// Deletes
    console.log("HELLO");
    if (document.querySelector('[data-delete]')) {

        document.querySelectorAll('[data-delete]').forEach(form => {

            // const form = document.querySelector('[data-delete]');
            const url = form.dataset.url;
            const data = {}
            form.addEventListener('submit', e => {
                const answer = confirm('Are jū šūre?');
                e.preventDefault();
                if (!answer) {
                    return false;
                }
                axios.post(url, data)
                    .then(function (response) {
                        displayMsg(response.data.msgType, response.data.message);
                        doBlockLoad();
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })
        })

    }
}

window.addEventListener('DOMContentLoaded', () => {
    doBlockLoad();
    /// SUBMITS
    if (document.querySelector('[data-submit]')) {
        const form = document.querySelector('[data-submit]');
        const url = form.dataset.url;
        form.addEventListener('submit', e => {
            e.preventDefault();
            const data = {};
            form.querySelectorAll('[id]').forEach(el => {
                data[el.id] = el.value;
            })
            axios.post(url, data)
                .then(function (response) {
                    form.reset();
                    displayMsg(response.data.msgType, response.data.message);
                    doBlockLoad();
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
        })
    }
});

*/