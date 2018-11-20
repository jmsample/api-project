(function () {

    document.addEventListener('DOMContentLoaded', function () {
        var path = window.location.pathname;
        var tag = path.substr(path.lastIndexOf('/') + 1);
        getArticles(tag);
        getArticles(tag);
    });

    function getArticles(tag) {
        tag = tag.trim() !== '' ? '/' + tag : '';
        var route = '/articles' + tag;
        var targetId = 'articles-table';

        sendRequest(route).then(function (response) {
            if (response) {
                setPageTitle('page-title-info', response.publication, response.tag);
                clearTable(targetId);
                var articles = response.data;

                if (articles.length) {
                    for (var i = 0; i < articles.length; i++) {
                        var row = constructTableRow(articles[i]);
                        appendTableRow(row, targetId);
                    }
                } else {
                    var row = constructPlaceholderRow();
                    appendTableRow(row, targetId);
                }
            }
        });
    }

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

    function constructTableRow(data) {
        var row = document.createElement('tr');
        var headlineCell = document.createElement('td');
        var headline = document.createElement('a');
        var excerptCell = document.createElement('td');
        var imageCell = document.createElement('td');
        var image = document.createElement('img');

        headline.innerHTML = data.title;
        headline.href = data.permalink;
        headline.target = '_blank';
        excerptCell.innerHTML = data.excerpt;
        image.src = data.images.medium.image;
        image.classList.add('image');

        headlineCell.appendChild(headline);
        imageCell.appendChild(image);

        row.appendChild(headlineCell);
        row.appendChild(excerptCell);
        row.appendChild(imageCell);

        return row;
    }

    function constructPlaceholderRow(data) {
        var row = document.createElement('tr');
        var cell = document.createElement('td');

        cell.classList.add('placeholder-cell');
        cell.setAttribute('colspan', '3');
        cell.innerHTML = 'No articles were found.';

        row.appendChild(cell);

        return row;
    }

    function clearTable(targetId) {
        targetId = targetId.charAt(0) === '#' ? targetId : '#' + targetId;
        var rows = document.querySelectorAll(targetId + ' > :not(tbody)');

        for (var i = 0; i < rows.length; i++) {
            rows[i].parentNode.removeChild(rows[i]);
        }
    }

    function appendTableRow(row, targetId) {
        targetId = targetId.replace('#', '');
        document.getElementById(targetId).appendChild(row);
    }

    function setPageTitle(targetId, publication, tag) {
        targetId = targetId.replace('#', '');
        tag = tag === null ? '' : ' - ' + tag;
        document.getElementById(targetId).innerHTML = ' - ' + publication + tag;
    }

})();