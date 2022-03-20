ReviewsController = {
    run: function () {

        document.getElementById('content-table').addEventListener('click', function (event) {
            event.preventDefault();
            let target = event.target;
            while (target.id !== 'content-table') {
                if (target.classList.contains('contacts')) {
                    let authorId = target.getAttribute('data-author');
                    console.log(authorId);
                    $.getJSON("/author/contacts?author_id=" + authorId, function(data){
                        mainUtilites.mustasheModalBuild('/site/author-contacts', data, 'Контакты');
                    });
                }
                target = target.parentNode;
            }
        });
    },
};

module.exports = ReviewsController;