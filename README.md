[![GitHub release](https://img.shields.io/github/release/PhilippMundhenk/Kirby-Table-of-Contents.svg)](https://github.com/PhilippMundhenk/Kirby-Table-of-Contents/releases) [![GitHub issues](https://img.shields.io/github/issues/PhilippMundhenk/Kirby-Table-of-Contents.svg)](https://github.com/PhilippMundhenk/Kirby-Table-of-Contents/issues) [![GitHub license](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://github.com/PhilippMundhenk/Kirby-Table-of-Contents/blob/master/LICENSE)

#Kirby Table of Contents
##Quick Reference
Table of Contents: (toc: 6)<br/>
number indicates the maximum level to be included, always starts at level 2

Headline 1: (l1: Headline1)<br/>
Headline 2: (l2: Headline2)<br/>
Headline 3: (l3: Headline3)<br/>
Headline 4: (l4: Headline4)<br/>
Headline 5: (l5: Headline5)<br/>
Headline 6: (l6: Headline6)

##Additional Options
The following are additional options for formatting the table of contents and the contained links
- levelchar: Allows to change the character used to separate different levels in the table of contents, usage: *levelchar: >* or *levelchar: space*

Note that the following options change the link behavior and thus need to be added to all tags that are supposed to work together, so the (toc), as well as all (l1), (l2), etc.
- split: Allows to change the replacement character for a space, example usage: *split: -*
- lowercase: Allows to change all letters in the link to lowercase, usage: *lowercase: 1*

###Example<br/>
(toc:6 split: - lowercase: 1 levelchar: >)<br/>
(l2: Test testä? split: - lowercase: 1)<br/>
(l3: Test2 testä? split: - lowercase: 1)<br/>

##Installation
copy to your kirby/site/tags folder

##Full Documentation & Demo
Please find the documentation and demo here: [www.mundhenk.org](http://www.mundhenk.org/blog/kirby-table-of-contents)