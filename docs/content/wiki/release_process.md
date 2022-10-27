+++
title = "Release Process"
+++

1.  Hardcode build date (the current value of $Date$, the last change);
2.  Change version from development to release number;
3.  Copy trunk/branch to releases/\[version number\] in SVN (e.g., `svn copy trunk releases/1.1.2`).
4.  Run `svn export` on that release and package for release as a ZIP (be careful to not get any files apart from those created by the export, such as those created by the <abbr title="Operating System">OS</abbr> like .DS_STORE and Thumbs.db);
5.  Update [Release Notes](@/wiki/misc/release_notes/_index.md);
6.  Upload to [http://simplepie.org/downloads/simplepie\_\[version number\].zip](/downloads/simplepie_%5Bversion%20number%5D.zip "http://simplepie.org/downloads/simplepie_[version number].zip");
7.  Update [http://simplepie.org/downloads/](/downloads/ "http://simplepie.org/downloads/");
8.  Mark version as shipped and set date on bug tracker, update target version;
9.  Post on blog, email simplepie-support.
