
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vehicle $vehicle
 */
?>
<!--Header-->
<div class="row text-body-secondary mb-3">
	<div class="col-10">
		<h1 class="my-0 page_title">
			<?php echo $title; ?>
		</h1>
		<h6 class="sub_title text-secondary">
			<?php echo $system_name; ?>
		</h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa-solid fa-bars"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
				<?= $this->Html->link(__('List Vehicles'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
			</div>
		</div>
	</div>
</div>
<div class="line mb-3 border-primary" style="border-width: 2px; border-radius: 5px;"></div>
<!--/Header-->

<div class="card mb-3 shadow-sm">
	<div class="card-header">
		<h5 class="mb-0">Add Vehicle</h5>
	</div>
	<div class="card-body">
		<?= $this->Form->create($vehicle, ['type' => 'file', 'class' => 'needs-validation', 'novalidate' => true]) ?>
		<fieldset>
			<div class="row mb-2">
				<div class="col-md-6">
					<?= $this->Form->control('model', ['label' => ['text' => 'Model', 'class' => 'form-label'], 'class' => 'form-control']); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->control('manufacturer', ['label' => ['text' => 'Manufacturer', 'class' => 'form-label'], 'class' => 'form-control']); ?>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-md-6">
					<?= $this->Form->control('registration_no', ['label' => ['text' => 'Registration No.', 'class' => 'form-label'], 'class' => 'form-control']); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->control('color', ['label' => ['text' => 'Color', 'class' => 'form-label'], 'class' => 'form-control']); ?>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-md-6">
					<?= $this->Form->control('type', [
						'label' => ['text' => 'Vehicle Type', 'class' => 'form-label'],
						'type' => 'select', 
						'options' => ['Car' => 'Car', 'Motorcycle' => 'Motorcycle'],
						'empty' => 'Select Vehicle Type',
						'class' => 'form-select'
					]); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->control('rate_perhour', ['label' => ['text' => 'Rate per Hour', 'class' => 'form-label'], 'class' => 'form-control']); ?>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-md-6">
					<?= $this->Form->control('image', [
						'type' => 'file', 
						'label' => ['text' => 'Upload Image', 'class' => 'form-label'],
						'class' => 'form-control'
					]); ?>
				</div>
				<div class="col-md-6">
					<?= $this->Form->control('status', ['label' => ['text' => 'Status', 'class' => 'form-label'], 'class' => 'form-control']); ?>
				</div>
			</div>
		</fieldset>
		<div class="text-end mt-3">
			<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning me-2']); ?>
			<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']); ?>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>


