<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');

?>
<!-- date -->
<div class="col-md-12 ">
	<div class="float-right">
	<?= $this->date("date", [
	       "format" => "d m Y",
	       "outputFormat" => "%d.%m.%Y"
	]); ?>
	</div>	
</div><br>
<!-- end date -->
<!-- Image -->
<?= $this->image("myImage",[
         "title"     => "Drage your image here",
         "width"     => "auto",
         "height"    => "300",
         "thumbnail" => "bannerimage",
         "attributes"=> [
              "custom-attr" => "value",
              "data-role"   => "image"
         ]
]); ?>
<!-- End Image -->
 <?= $this->select("select", [
     "store" => [
         ["option1", $this->translate("Option One", [], "admin")],
         ["option2", $this->translate("Option Two", [], "admin")],
         ["option3", $this->translate("Option Three", [], "admin")]
     ]
 ]); ?>
<!-- page backward navigation -->
<br>
<div class="col-md-12" align="left">
	<?= $this->link('bloglink'); ?><i class="fa fa-arrow-right" style="color: blue;font-size: 14px;"></i><?= $this->input('headline'); ?>
</div>
<!-- end page backword navigation -->
<!-- headline editable block -->
<div class="col-md-12" align="center">
<h1><?= $this->input("headline", ["width" => 540]); ?></h1>
</div>
<!-- end headline editable block -->
<!-- checkbox editable block -->
<?= $this->checkbox("myCheckbox"); ?>
<!-- end checkbox editable block -->
<!--  header and description & gallery single image block -->

<?php while($this->block("contentblock")->loop()) { ?>
    <h2><?= $this->input("subline"); ?></h2>
    <?= $this->wysiwyg("content"); ?>
<?php } ?>
<div>
    <?= $this->area('myArea', [
        'type' => 'gallery-single-images',
        'params' => [
            'gallery-single-images' => [
                'param1' => 123,
                "forceEditInView" => true,
                "editWidth" => "800px",
                "editHeight" => "500px"
            ]
        ]
    ]); ?>
</div> 
<!-- end header and description & gallery single image block -->

<!-- select content editable block -->

<!-- <?php while($this->block("contentblock")->loop()) { ?>
    <?php if($this->editmode) { ?>
        <?= $this->select("blocktype", [
            "store" => [
                ["wysiwyg", "WYSIWYG"],
                ["contentimages", "WYSIWYG with images"],
                ["video", "Video"]
            ],
            "reload" => true
        ]); ?>
    <?php } ?>
     
    <?php if(!$this->select("blocktype")->isEmpty()) {
        $this->template("content/blocks/".$this->select("blocktype")->getData().".php");
    } ?>
<?php } ?>
 
<?php while($this->block("teasers", ["limit" => 2])->loop()) { ?>
    <?= $this->snippet("teaser") ?>
<?php } ?> -->

<!-- ednd select content editable block -->

<div class="product-info">
    <?php if($this->editmode):
        echo $this->relation('product');
    else: ?>
    <div id="product">
        <?php
        /** @var \Pimcore\Model\DataObject\Product $product */
        $product = $this->relation('product')->getElement();
        ?>
        <h2><?= $this->escape($product->getName()); ?></h2>
	        <div class="content">
			    <?php 
			    $picture = $product->getPicture();
			    if($picture instanceof \Pimcore\Model\Asset\Image):
			        /** @var \Pimcore\Model\Asset\Image $picture */
			        
			    ?>
			        <?= $picture->getThumbnail("content")->getHtml(); ?>
			    <?php endif; ?>
			    <?= $product->getDescription(); ?>
			</div>
    </div>
    <?php endif; ?>
</div>