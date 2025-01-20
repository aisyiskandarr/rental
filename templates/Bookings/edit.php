<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $vehicles
 */
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-bars text-primary"></i>
			</button>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $booking->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
            ) ?>
            <?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($booking, ['type' => 'file']) ?>
            <fieldset>
                
                    <div class="row">
                        <div class="col-md-6"><?php echo $this->Form->control('users_id', ['options' => $users, 'empty' => 'Select User', 'class' => 'form-select']); ?></div>
                        <div class="col-md-6"><?php echo $this->Form->control('vehicles_id', ['options' => $vehicles, 'empty' => 'Select vehicles', 'class' => 'form-select']); ?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><?php echo $this->Form->control('booking_date', ['value' => date  ('Y-m-d'), 'readonly' => true]); ?></div>
                        <div class="col-md-4"><?php echo $this->Form->control('start_date'); ?></div>
                        <div class="col-md-4"><?php echo $this->Form->control('end_date'); ?></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><?php echo $this->Form->control('nric', ['label' => 'IC Number']); ?></div>

                        <div class="col-md-4"><label>Upload license<?php echo $this->Form->control('license', ['type' => 'file',  'class' => 'form-control', 'label' => false]); ?></div>
                        
                        <div class="col-md-4"><?php echo $this->Form->control('hours');?></div>
                    </div>

                    <div class="row">
                    <div class="col-md-4"><?php echo $this->Form->control('total_amount'); ?></div>
                    </div>

                    <div class="card-title md-0 mt-3">Price per hour</div>
                    <div class="tricolor_line mb-2"></div>
                        Bike - RM 7
                    <br> Car - RM 10
                    <br>
                    <br> Total Amount = Hour * Price Per Hour
               
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>