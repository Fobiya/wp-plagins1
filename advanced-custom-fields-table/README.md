
## advanced-custom-fields-table


```php

  <?php $table = get_field('tables');

          if ($table) {

            if ($table['header']) { ?>
               <ul class="title <?= get_row_index(); ?>">
                   <?php   foreach ($table['header'] as $th) { ?>

                      <li><?= $th['c']; ?></li>

               <?php  }  ?>
                </ul>
            <?php  } ?>



            <?php $number__ = '1'; ?>

            <?php  foreach ($table['body'] as $tr) { ?>

                <ul class="content cont<?= $number__++; ?>">

                    <?php   foreach ($tr as $key => $td) { ?>


                        <li><?= $td['c']; ?></li>

                    <?php } ?>
                </ul>

               <?php } ?>


         <?php  } ?>
         
         
```