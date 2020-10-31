# Mirele Canonical

Mirele is a universal template for most types of sites, from a personal writer's blog and own store to a forum with a small social network. Mirele has its own system of levels of abstraction, which allows him to be easily expandable at lower levels of abstraction, so as all the relationships between the bloods are perfectly clear and documented. 

Mirele has a system of letter symbols for architectures. For example, Mirele with architecture number 1 will have a code and promoted the name "Mirele A1", and Mirele with forked architecture will have a different letter in the name, but he will not be able to use the letter "A", as it refers to the standard architecture of the project. For example, the old Mirele architectures were called "Mirele S1". These versions are not available for sale. Officially, the counting of Mirele architectures begins with the second version. 

Mirele Canonical is the full name of the whole project. 

#### Table of composition of each architecture

| Name of architecture | Render page | Template Engine | Complex Manager            | Signature verify engine | Developing Tools Kit |
|----------------------|-------------|-----------------|----------------------------|-------------------------|----------------------|
| Mirele Z1            | Aneli       | —               | —                          | —                       | —                    |  
| Mirele S1            | Rosemary    | —               | —                          | —                       | —                    | 
| Mirele A1            | Rosemary    | —               | —                          | Mirele Verify Signature | —                    |  
| Mirele A2            | Compound    | TWIG            | Vendor CTB -> Autoloader   | —                       | Hammer&Wrench        |

## Mirele for developers 

Not only standard technologies are used in Mirele's development, but also some compilers are required. For example, for compiling SASS in CSS, the SASS utility is used. JS files are also compiled using Babel.  

#### Table of technologies and compilers used

| File Type | Compiler | UNIX Util |
|-------|------|-------|
| .js | Babel | ```bush npx babel $FileName$ --out-file $FileNameWithoutExtension$.min.js --source-maps inline --presets minify --no-comments``` |
| .sass | SASS | ```bush sass $FileName$:$FileNameWithoutExtension$.css --style compressed``` |
| .css | Autoprefixer | ```bush postcss $FileName$ --use autoprefixer --autoprefixer.browsers "last 120 version" $FileName$ -o $FileNameWithoutExtension$.css``` |

## Mirele for managers

Mirele development began in May 2020. From May 2020 to June 2020, Mirele was open. It was possible to install new blocks, expand it with additional functions, etc. At the end of June, Mirele was rewritten and changed its architecture, as well as changed its policy - now it is a single product aimed exclusively at its style, its blocks, its internal extensions.
On August 26, 2020 there was a refusal of further support of own architectures. Because of this, the architecture of MIrele was replaced by A2

| Name of architecture | URL |
|------|-------|
| S1 Architecture | https://github.com/irtex-web/mirele-a1/tree/aa5a70a09aeec2036137f4a9585210805aa95e70 |
| A1 Architecture | https://github.com/irtex-web/mirele-a1/tree/313878ba2fd8a9ccfa69513ff78a77804f22def2 |
| A2 Architecture | https://github.com/irtex-web/mirele-a1 |

Actual map of the file structure image: github.com/irtex-web/mirele-a1/blob/master/tree.md

Mirele's development path is the responsibility of the road map.

#### Implementation of the road map 

| Date of event | Event |
|---|---|
| 03.10.2020 | Approval of the first minimal working version of the Compound page engine |
| 03.10.2020 | Scalable AXIOS bridge for Compound VUE implementation created.  |
| 10.10.2020 | Compound acquires marketing qualities and begins to be listed as completed at the MRI stage.  |
| 13.10.2020 | Initial approval of the router of AJAX requests |
| 15.10.2020 | A system of strategies has been established (authorization of requests is the main objective) |
|  |  |