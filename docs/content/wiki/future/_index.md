+++
title = "The Future Of SimplePie"
+++

This page provides an outline regarding the general future direction of SimplePie. More information regarding SP2 can be found [here](@/wiki/sp2/_index.md).

## System Requirements {#system_requirements}

### SimplePie 1.1/1.2 {#simplepie_1112}

- SHOULD support <abbr title="Hypertext Preprocessor">PHP</abbr> 4.3
- MUST support <abbr title="Hypertext Preprocessor">PHP</abbr> 4.4 and 5.0–5.2
- MUST require at most the PCRE and <abbr title="Extensible Markup Language">XML</abbr> extensions

### SimplePie 1.5 {#simplepie_15}

- MUST support <abbr title="Hypertext Preprocessor">PHP</abbr> 5.0–5.2 and 6.0

### SimplePie 2.0 {#simplepie_20}

- SHOULD support <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2
- MUST support <abbr title="Hypertext Preprocessor">PHP</abbr> 6.0

## Coding Standards {#coding_standards}

### SimplePie 1.1/1.2 {#simplepie_11121}

- MUST run without any errors/warnings/notices under E_ALL on <abbr title="Hypertext Preprocessor">PHP</abbr> 4.4 and 5.2

### SimplePie 1.5 {#simplepie_151}

- MUST run without any errors/warnings/notices under E_ALL on <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2
- SHOULD run without any notices under E_STRICT on <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2

### SimplePie 2.0 {#simplepie_201}

- SHOULD run without any errors/warnings/notices under E_ALL | E_STRICT on <abbr title="Hypertext Preprocessor">PHP</abbr> 5.2
- MUST run without any errors/warnings/notices under E_ALL | E_STRICT on <abbr title="Hypertext Preprocessor">PHP</abbr> 5.3
- MUST run without any errors/warnings/notices under E_ALL on <abbr title="Hypertext Preprocessor">PHP</abbr> 6.0
