# SimplePie Roadmap

This roadmap is a guide for what we're heading towards with SimplePie releases.
These are guiding features, however more may be included in each release.

## 1.4
* **Split the feed-level methods out of the main SimplePie class**

  This will make the main SimplePie class the main API for setting options.

* **Deprecate SimplePie_File**

  There are much better HTTP libraries out there than the included one. Instead,
  enable easy use of Guzzle and Requests via a new API, using Requests by
  default via Composer.

## 1.5
* **Improve performance and memory usage**

  SimplePie's performance leaves much to be desired, so this should be the focal
  point of this release.

## 1.6
* **To be determined**