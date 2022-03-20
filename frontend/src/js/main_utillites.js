mainUtilites = {
    mustasheModalBuild: function (templateID, data, headerStr) {
        $.ajax({
            url: templateID,
            type: 'GET',
            success:
                function (template) {
                    console.log(template);
                    console.log(data);
                    console.log(headerStr);
                    let render = Mustache.render(template, data);

                    document.getElementById('modalLabel').innerHTML = '<p>'+headerStr+'</p>';
                    document.getElementById('modalBody').innerHTML = render;
                }

        });
    },
};

module.exports = mainUtilites;