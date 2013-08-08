pyro-socialist-field
====================

A field type for PyroCMS that allows creating list items with labels -- useful for predefined lists that vary in size.

##### Field Creation

![field_creation.png](https://raw.github.com/james2doyle/pyro-socialist-field/master/field_creation.png)

##### Form Submission

![form_submission.png](https://raw.github.com/james2doyle/pyro-socialist-field/master/form_submission.png)

#### Usage

* Create a new "Socialist" field
* Add the labels for the fields you want (leaving a field blank, removes it on save)
* Go to the page with the field
* Fill out the field and save

#### Client Side -- Front End

The field returns an array so it needs to be treated that way. The `key` is the label/network name you entered. The `value` is the input fields value.

```html
<ul>
  {{ page:my_field_slug }}
  <li><a href="{{ value }}">{{ key }}</a></li>
  {{ /page:my_field_slug }}
</ul>
```

Here is the result of the information in the screenshots:

```html
<ul>
  <li><a href="http://youtube.com">Youtube</a></li>
  <li><a href="http://facebook.com">Facebook</a></li>
  <li><a href="http://twitter.com">Twitter</a></li>
</ul>
```
