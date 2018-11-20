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
                var articles = response.data;
                for (var i = 0; i < articles.length; i++) {
                    var row = constructTableRow(articles[i]);
                    appendTableRow(row, 'articles-table');
                }
            }
        });
    }

    // send request
    function sendRequest(route, method) {
        method = method || 'GET';
        var baseUrl = document.getElementById('baseUrl').getAttribute('content');
        var url = baseUrl + route;
        var xhr = new XMLHttpRequest();

        return new Promise(function(resolve, reject) {
            xhr.responseType = 'json';
            xhr.open(method, url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    resolve(xhr.response);
                }
            }
            xhr.send();
        });

    }
    // construct table row
    function constructTableRow(data) {
        var row = document.createElement('tr');
        var headlineCell = document.createElement('td');
        var headline = document.createElement('a');
        var excerptCell = document.createElement('td');
        var imageCell = document.createElement('td');
        var image = document.createElement('img');

        headline.innerHTML = data.title;
        headline.href = data.permalink;
        excerptCell.innerHTML = data.excerpt;
        image.src = data.images.medium.image;

        headlineCell.appendChild(headline);
        imageCell.appendChild(image);

        row.appendChild(headlineCell);
        row.appendChild(excerptCell);
        row.appendChild(imageCell);

        return row;
    }
    // append table row
    function appendTableRow(row, target) {
        document.getElementById(target).appendChild(row);
    }

})();