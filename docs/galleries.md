### Image sizing
Resize images to fit 2100x1400px on the longest edge, saved at JPG quality 6.

<img src="img/gallery-scaling-pm.png" width=500 />

### Creating a gallery

1. Pages > Add new
2. Give the page a title. Do not add any text content.
3. Add Media > Insert Gallery
4. Upload images and insert captions.
5. Insert Gallery

Note: The _Link To_ and _Columns_ settings are not used by SoloFolio.


### Auto play
1. Go to the Text view for the page
2. Add `autoplay="true" speed="3000"` to the `[gallery]` shortcode, where `speed` is the time (in milliseconds) to show each image

`[gallery autoplay="true" speed="3000"]`

### Thumbnails
![Kent Nishimura thumbnails view](img/kent-thumbs.jpg)

__To display thumbnails as default:__

1. Go to the Text view for the page
2. Add the `thumbs="true"` to the `[gallery]` shortcode:

`[gallery thumbs="true"]`

__To disable thumbnails:__

1. Go to the Text view for the page
2. Add the `thumbnails_enabled="false"` to the `[gallery]` shortcode:

`[gallery thumbnails_enabled="false"]`

### Title slides
![Gallery title slides example](img/gallery-title-slide.jpg)

To add a title slide to a gallery, set the solofolio-gallery-title and solofolio-gallery-text custom fields.

![Gallery title slide settings](img/gallery-title-slide.png)
