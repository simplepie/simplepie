+++
title = "Avoid raw HTML entities"
+++

Using JavaScript's built-in <abbr title="Document Object Model">DOM</abbr> methods can be a hassle when you're trying to add text to a new <abbr title="Document Object Model">DOM</abbr> node. The correct way of adding text to a node is to use `document.createTextNode()`, although a popular alternative is `element.innerHTML`. Additionally, some libraries (like [Scriptaculous](http://script.aculo.us)) have <abbr title="Document Object Model">DOM</abbr> creation helpers built-in for more easily creating new <abbr title="HyperText Markup Language">HTML</abbr> dynamically.

If you're trying to add text from [feed.title](@/wiki/live/reference/feed.title.md) (or another text-based value) that contains an <abbr title="HyperText Markup Language">HTML</abbr> entity, you typically run into issues where the <abbr title="HyperText Markup Language">HTML</abbr> entity is displayed literally instead of being converted to the intended character… and that sucks. The simplest way to work around such issues when generating <abbr title="HyperText Markup Language">HTML</abbr> on-the-fly using <abbr title="Document Object Model">DOM</abbr> methods is to create empty nodes with id's assigned to them (i.e. `<div id=“boogers”></div>`), and then use `innerHTML` to add the content to the nodes after they've been added to the <abbr title="Document Object Model">DOM</abbr> tree.

## Examples {#examples}

The following code will have the body of the page display “You &amp; I.”

```javascript
var phrase = "You &amp; I.";
var span = document.createElement('span');
span.appendChild(document.createTextNode(phrase));
document.body.appendChild(span);
```

The following code will have the body of the page display “You & I.”, which is what we want.

```javascript
var phrase = "You &amp; I.";
var span = document.createElement('span');
span.id = 'myId';
document.body.appendChild(span);
document.getElementById('myId').innerHTML = phrase;
```

If you were using Scriptaculous' `Builder.node()` functionality, you'd do the following to get the translated <abbr title="HyperText Markup Language">HTML</abbr> entities (like we want).

```javascript
var phrase = "You &amp; I.";
document.body.appendChild(
    Builder.node('span', {'id':'myId'})
);
$('myId').innerHTML = phrase;
```
