+++
title = "More on Method Names"
date = 2006-12-01T13:58:00Z

[extra]
author = "Geoffrey Sneddon"
cover_image = "/images/128/designer.png"
cover_image_alt = "Designer"
+++

<div lang="en-GB">

A month or two ago, we ran a poll with three options: drop `get_` from method names, add `set_` to others, or leave it as is. The result was overwhelmingly for the second option, adding `set_`.

One month ago, I changed the methods that directly interact with the SimplePie class. This proved controversial, despite the fact people writing PHP _really_ should know that development code should _not_ be relied upon, knowing that it may not work, or break backwards compatibility without warning. There’s been various <s>discussions</s> <u>arguments</u> about whether other verbs (such as enable) should be used in some of the method names. Anyone got any thoughts?

The second issue is to do with SimplePie_Item::get_description(). If we’re to have two methods – one that gets the description, and another that gets the content (or description, if that doesn’t exist), what should the methods be called? I’m in favour of the description method being SimplePie_Item::get_description() and the content method being SimplePie_Item::get_content(), thereby breaking backwards compatibility; however, I’m open to suggestions.

Lastly, anyone interested in mailing lists, for either announcements or support?

</div>
