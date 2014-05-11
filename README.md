FlipFlop
========

FlipFlop Weekly's website, where the magic happens.

> Built with [Jekyll](http://jekyllrb.com/), hosted on [GitHub Pages](https://pages.github.com/)

## Contributing

Checkout [Jekyll](http://jekyllrb.com/)'s documentation, then:

```
  gem install jekyll
  cd FlipFlop
  jekyll serve
```

After this initial setup, working on the site feels like working with any HTML/CSS static website. Except there are variables that are filled and used when running `jekyll build`.

## File structure

```

# Contains the site's configuration.

├── _config.yml

# Templates used to render content.

├── _layouts
│   ├── default.html
│   └── post.html

# Jekyll plugins, used at build time.

├── _plugins
│   ├── rssgenerator.rb
│   └── sitemap_generator.rb

# Content units. Here, those are FlipFlop Weekly editions.

├── _posts
│   ├── *.markdown

# Where the site gets generated.

├── _site

# CSS, JavaScript and static files.

├── CNAME
├── index.html
├── favicon.ico
├── flipflop-logo.png

├── css

└── js
```
