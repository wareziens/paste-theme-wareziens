paste-theme-wareziens
=====================

https://github.com/adaur/Paste theme for http://wareziens.net

#Installation

Clone this into the templates directory.

```
npm install && bower install && gulp
```

#Development

```
gulp watch
```

Bootstrap settings can be overriden in `scss/_settings`

#Configuration

This uses [highlight.js](http://highlightjs.org/) over Geshi to syntax colorization. To replace colors please replace this variables in the config.php file :

```php
$CONF['geshi_enabled'] = false;

// Available formats (All GeSHi formats are here)
$CONF['geshiformats']=array(
'1c' => '1c',
'clojure' => 'clojure',
'diff' => 'diff',
'http' => 'http',
'matlab' => 'matlab',
'python' => 'python',
'sql' => 'sql',
'actionscript' => 'actionscript',
'cmake' => 'cmake',
'django' => 'django',
'ini' => 'ini',
'mel' => 'mel',
'r' => 'r',
'tex' => 'tex',
'text' => 'text',
'apache' => 'apache',
'coffeescript' => 'coffeescript',
'dos' => 'dos',
'java' => 'java',
'nginx' => 'nginx',
'rib' => 'rib',
'vala' => 'vala',
'applescript' => 'applescript',
'cpp' => 'cpp',
'erlang-repl' => 'erlang-repl',
'javascript' => 'javascript',
'objectivec' => 'objectivec',
'rsl' => 'rsl',
'vbscript' => 'vbscript',
'avrasm' => 'avrasm',
'cs' => 'cs',
'erlang' => 'erlang',
'json' => 'json',
'parser3' => 'parser3',
'ruby' => 'ruby',
'vhdl' => 'vhdl',
'axapta' => 'axapta',
'css' => 'css',
'glsl' => 'glsl',
'lisp' => 'lisp',
'perl' => 'perl',
'rust' => 'rust',
'xml' => 'xml',
'html' => 'xml',
'bash' => 'bash',
'd' => 'd',
'go' => 'go',
'lua' => 'lua',
'php' => 'php',
'scala' => 'scala',
'brainfuck' => 'brainfuck',
'delphi' => 'delphi',
'haskell' => 'haskell',
'markdown' => 'markdown',
'profile' => 'profile',
'smalltalk' => 'smalltalk');

// The formats that are listed first.
$CONF['popular_formats']=array(
	'text','diff','html','css','javascript','php',
	'perl','python','sql','ruby','xml','java','c','cs','cpp'
);
```

#Highlightjs supported languages
```
1c
clojure
diff
http
matlab
python
sql
actionscript
cmake
django
ini
mel
r
tex
apache
coffeescript
dos
java
nginx
rib
vala
applescript
cpp
erlang-repl
javascript
objectivec
rsl
vbscript
avrasm
cs
erlang
json
parser3
ruby
vhdl
axapta
css
glsl
lisp
perl
rust
xml
bash
d
go
lua
php
scala
brainfuck
delphi
haskell
markdown
profile
smalltalk
```