<?php 
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rating $rating
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $bookings
 */
?>
<!--Header-->
<div<div class="header mb-4">
    <div class="row align-items-center">
        <div class="col-10">
            <h1 class="my-0 page_title"><i class="fa-solid fa-star"></i> <?php echo $title; ?></h1>
            <h6 class="sub_title text-light"><?php echo $system_name; ?></h6>
        </div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-bars text-primary"></i>
			</button>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rating->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
            ) ?>
            <?= $this->Html->link(__('List Ratings'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
        <?= $this->Form->create($rating) ?>
        <fieldset>
            <legend><?= __('Edit Rating') ?></legend>

            <div class="row">
                <div class="col-md-4">
                    <?php echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-select']); ?>
                    <?php echo $this->Form->control('bookings_id', ['options' => $bookings, 'class' => 'form-select']); ?>
                    <?php echo $this->Form->control('vehicles_id',['class' => 'form-select']); ?>

                    
                    <label for="rate">
                        <?php echo __('Rate'); ?>
                        <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                    </label>
                    <div class="star-rating">
                        <input type="radio" id="star5" name="rate" value="5" <?= $rating->rate == 5 ? 'checked' : '' ?>>
                        <label for="star5" class="star">&#9733;</label>

                        <input type="radio" id="star4" name="rate" value="4" <?= $rating->rate == 4 ? 'checked' : '' ?>>
                        <label for="star4" class="star">&#9733;</label>

                        <input type="radio" id="star3" name="rate" value="3" <?= $rating->rate == 3 ? 'checked' : '' ?>>
                        <label for="star3" class="star">&#9733;</label>

                        <input type="radio" id="star2" name="rate" value="2" <?= $rating->rate == 2 ? 'checked' : '' ?>>
                        <label for="star2" class="star">&#9733;</label>

                        <input type="radio" id="star1" name="rate" value="1" <?= $rating->rate == 1 ? 'checked' : '' ?>>
                        <label for="star1" class="star">&#9733;</label>
                    </div>
                </div>

              
                <div class="col-md-6">
                    <?php echo $this->Form->control('comment'); ?>
                    
                </div>
            </div>

       
        </fieldset>
        <div class="text-end">
            <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
            <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<!-- css -->
<style>
    <style>
    .header {
        background: linear-gradient(90deg,rgb(37, 37, 37) 100%,rgb(56, 56, 56) 100%);
        color: #fff;
        padding: 10px;
        border-radius: 5px;
    }
    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
   
    .dropdown-item i {
        margin-right: 8px;
    }

    .star-rating {
        direction: rtl;
        font-size: 2rem;
        user-select: none;
        text-align: left;
    }
    .star {
        color: #d3d3d3;
        cursor: pointer;
        transition: color 0.3s;
    }
    .star:hover,
    .star:active,
    input[type="radio"]:checked ~ .star {
        color: #FFD43B;
    }
</style>