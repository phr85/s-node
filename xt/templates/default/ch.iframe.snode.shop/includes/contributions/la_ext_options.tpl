{if $DATA.gift == 1}{actionIcon
     action = "unsetGift"
     icon    = "package.png"
     form    = "article"
     title   = "unsets this products gift status"
     yoffset = "1"
     article_id=$DATA.article_id
}{else}{actionIcon
     action = "setGift1"
     icon    = "package_add.png"
     form    = "article"
     title   = "Sets this product as gift1"
     yoffset = "1"
     article_id=$DATA.article_id
}{/if}{if $DATA.gift == 2}{actionIcon
     action = "unsetGift"
     icon    = "package.png"
     form    = "article"
     title   = "unsets this products gift status"
     yoffset = "1"
     article_id=$DATA.article_id
}{else}{actionIcon
     action = "setGift2"
     icon    = "package_add.png"
     form    = "article"
     title   = "Sets this product as gift2"
     yoffset = "1"
     article_id=$DATA.article_id
}{/if}
