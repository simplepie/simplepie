+++
title = "Repositories"
+++

SP2 is developed out of multiple [Mercurial](http://selenic.com/mercurial) repositories, each with their own requirements to get code “pulled” into them. They are all named by their owner's username, with the main repository having no prefix, and others having prefixes starting with a hyphen (”-”). Exemptions can be granted from any of the given requirements for any submission by the repository's owner, however, these exemptions are _very_ rarely given, and almost always in cases of force majeure.

## gsnedders {#gsnedders}

This is the authoritative repository, where all releases are taken from. As such, it is also the hardest to get code into. The requirements are:

- All <a href="@/wiki/sp2/dev/coding_standards.md" class="wikilink2">coding_standards</a> must be obeyed.
- Must cause no unit test regressions.
- Must include unit tests to cover 100% of the source-base.
- Must update the included documentation to reflect any relevant changes.

There are various things to be aware of:

- Two weeks before release, the repository enters a _feature freeze_, after which no new features are committed (no matter how irrelevantly minor).
- One week before release, the repository enters a _hard freeze_, after which only release critical bugs are fixed. Any other bug will not be fixed till the next release.

For further information, see <a href="@/wiki/sp2/dev/release_cycle.md" class="wikilink2">release_cycle</a>.
