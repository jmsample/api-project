(function () {

    document.addEventListener('DOMContentLoaded', function () {
        var path = window.location.pathname;
        var tag = path.substr(path.lastIndexOf('/') + 1);
        getArticles(tag);
    });

    function getArticles(tag) {
        tag = tag.trim() !== '' ? '/' + tag : '';
        var route = '/articles' + tag;

        sendRequest(route).then(function (response) {
            if (response) {
                var articles = response.articles;
                for (var i = 0; i < articles; i++) {
                    var row = constructTableRow(articles[i]);
                    appendTableRow(row, '#articles-table');
                }
            }
        });
    }

    // send request
    function sendRequest(route, method) {
        method = method || 'GET';
        var baseUrl = document.getElementById('baseUrl').getAttribute('content');

        var xhr = new XMLHttpRequest();
        var url = baseUrl + route;

        return new Promise(function(resolve, reject) {
            xhr.open(method, url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    resolve(xhr.responseText);
                }
            }
            xhr.send();
        });

    }
    // construct table row
    function constructTableRow(data) {

    }
    // append table row
    function appendTableRow(row, target) {

    }

})();