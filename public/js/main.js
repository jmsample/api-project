(function () {

    document.addEventListener('DOMContentLoaded', function () {
        var path = window.location.pathname;
        var tag = path.substr(path.lastIndexOf('/') + 1);
        getArticles(tag);

        document.getElementById('publication').addEventListener('change', getArticlesViaEvent);
    });

    function getArticles(tag) {
        tag = typeof tag !== 'undefined' && tag.trim() !== '' ? '/' + tag : '';
        var publication = getSelectedPublication();
        var route = '/articles' + tag + publication;
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

    function getArticlesViaEvent() {
        getArticles();
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
        var baseUrl = document.getElementById('baseUrl').getAttribute('content');
        var row = document.createElement('tr');
        var headlineCell = document.createElement('td');
        var headline = document.createElement('a');
        var excerptCell = document.createElement('td');
        var imageCell = document.createElement('td');
        var image = document.createElement('img');
        var tagCell = document.createElement('td');
        var tag = document.createElement('a');

        headline.innerHTML = data.title;
        headline.href = data.permalink;
        headline.target = '_blank';

        excerptCell.innerHTML = data.excerpt;

        image.src = data.images.medium.image;
        image.classList.add('image');

        tag.classList.add('tag');

        for (var i = 0; i < data.tags.length; i++) {
            var tagData = data.tags[i];
            tag = tag.cloneNode(false);
            tag.innerHTML = capitalizeWords(tagData.name);
            tag.href = baseUrl + '/' + tagData.slug;
            tagCell.appendChild(tag);
        }

        headlineCell.appendChild(headline);
        imageCell.appendChild(image);

        row.appendChild(headlineCell);
        row.appendChild(excerptCell);
        row.appendChild(imageCell);
        row.appendChild(tagCell);

        return row;
    }

    function constructPlaceholderRow() {
        var row = document.createElement('tr');
        var cell = document.createElement('td');

        cell.classList.add('placeholder-cell');
        cell.setAttribute('colspan', '4');
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

    function capitalizeWords(words) {
        return words.split(' ').map(function (word) {
            return word.charAt(0).toUpperCase() + word.substr(1);
        }).join(' ');
    }

    function getSelectedPublication() {
        var publication = '';
        var dropdown = document.getElementById('publication');

        if (dropdown !== null) {
            publication = '?publication=' + dropdown.options[dropdown.selectedIndex].value;
        }

        return publication;
    }

})();