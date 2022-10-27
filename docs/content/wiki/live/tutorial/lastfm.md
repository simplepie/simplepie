+++
title = "Last.fm Demo"
+++

[Last.fm](http://last.fm) is a popular music service that has integration with a variety of desktop music players such as iTunes, Windows Media Player, Winamp, and many others. When you listen to music on your computer, it will automatically update on your Last.fm account. You can use this to easily display your most recent tracks on your website.

There was an old version of this tutorial that was put together back when we were working on SimplePie Beta 2. Since SimplePie Live is _designed_ for <abbr title="Asynchronous JavaScript and XML">AJAX</abbr>-style uses, we'll replace that old tutorial with this new one.

## Compatibility {#compatibility}

- Requires SimplePie Live public beta.
- This demo uses native JavaScript <abbr title="Document Object Model">DOM</abbr> methods to provide the greatest amount of compatibility across browsers.

## Example {#example}

The following code sample can be previewed at the [Last.fm with SimplePie Live](http://live.simplepie.org/demo/lastfm/) demo.

```javascript
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <title>Last.fm with SimplePie Live!</title>
    <script src="http://live.simplepie.org/app/0.5/base.js" type="text/javascript" charset="utf-8"></script>

    <style type="text/css">
    <!--
    body {
        background-color:#eee;
        color:#333;
        font:11px/16px verdana;
    }

    a, a:visited {
        font-weight:bold;
        color:#000;
        text-decoration:none;
        border-bottom:1px dotted #333;
    }

    a:visited { font-weight:normal; }

    a:hover {
        color:#fff;
        background-color:#333;
        border-bottom:none;
    }

    div#lastfm {
        margin:30px auto;
        padding:10px;
        width:250px;
        background-color:#fff;
        border:1px solid #999;
    }

    div#lastfm h2 {
        font-size:16px;
        font-weight:bold;
        margin:0;
        padding:0 0 10px 0;
    }

    div#lastfm ul,
    div#lastfm ul li {
        list-style:none;
        margin:0;
        padding:0;
    }

    div#lastfm ul li {
        padding:5px 0;
    }

    div#lastfm div#indicator {
        text-align:center;
    }
    -->
    </style>
</head>
<body>
    <p style="text-align:center;">You are viewing the <a href="http://simplepie.org/wiki/live/tutorial/lastfm">Last.fm with SimplePie Live!</a> demo.</p>

    <!-- DIV THAT THE SCRIPT WILL WRITE TO -->
    <div id="lastfm">
        <h2>Recent Last.fm Tracks</h2>
        <div id="indicator"><img src="http://live.simplepie.org/demo/indicator.gif" alt="loading..." id="indicator" /></div>
        <ol id="lastfm_list"></ol>
    </div>

    <script type="text/javascript" charset="utf-8">
    <!--

    // Make sure the indicator is visible
    document.getElementById('indicator').style.display = 'block';

    // Initialize a new SimplePie() object.
    var f = new SimplePie('http://ws.audioscrobbler.com/1.0/user/skyzyx/recenttracks.rss', {

        // Handle a successful response
        onSuccess: function (feed) {

            // Update the list
            document.getElementById('lastfm_list').innerHTML = '';

            // Store the number of items in a variable so that it processes faster.
            var itemLength = feed.items.length;

            // As long as we have at least one item...
            if (itemLength > 0) {

                // Loop through them and add them all.
                for (var x = 0; x < itemLength; x++) {

                    // We'll use this to refer to a specific item
                    var item = feed.items[x];

                    // Let's prepare our HTML
                    var li = document.createElement('li');
                    li.id = f.getGuid();
                    document.getElementById('lastfm_list').appendChild(li);

                    // Display it the way we want.
                    document.getElementById(li.id).innerHTML = '<a href="' + item.permalink + '">' + item.title + '</a>';
                }
            }

            // If there are no items in the feed...
            else {
                // Add a message of nothingness
                var li = document.createElement('li');
                li.appendChild(document.createTextNode('There are no recent tracks to display. Sorry about that.'));
                document.getElementById('lastfm_list').appendChild(li);
            }

            // Hide the indicator when we're done.
            document.getElementById('indicator').style.display = 'none';
        },

        // Handle a failed response
        onFailure: function (feed) {

            // Update the list
            document.getElementById('lastfm_list').innerHTML = '<li>' + feed.error + '</li>';

            // Hide the indicator when we're done.
            document.getElementById('indicator').style.display = 'none';
        }
    });

    -->
    </script>
</body>
</html>
```
