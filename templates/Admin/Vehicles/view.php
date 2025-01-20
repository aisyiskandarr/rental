<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vehicle $vehicle
 */
?>

<!-- Receipt Header -->
<div class="row text-primary">
    <div class="col-12 text-center">
        <h1 class="fw-bold">Fleet Car Rental</h1>
        <p class="text-muted small">Generated on: <?= date('Y-m-d H:i:s') ?></p>
        <hr class="border-primary">
    </div>
</div>

<!-- Receipt Body -->
<div class="card rounded-3 mb-4 bg-light border-0 shadow-lg">
    <div class="card-body text-dark">
        <h3 class="text-center text-primary mb-4">Vehicle Details</h3>

        <!-- Vehicle Image and Model Name -->
        <div class="text-center mb-4">
            <?= $this->Html->image('../files/vehicles/image/' . $vehicle->image, ['style' => 'width: 400px; height: auto;']); ?>
            <h4 class="mt-3 text-primary fw-bold" style="font-family: 'Bangers', sans-serif; font-size: 40px;"><?= h($vehicle->model) ?></h4>
        </div>

        <!-- Vehicle Information in Two Columns -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-3 text-center">
                    <strong class="text-black d-block" style="font-size: 20px;">
                        <i class="fa fa-cogs text-primary me-2" style="font-size: 24px;"></i>Manufacturer:
                    </strong>
                    <p class="text-black" style="font-size: 18px;"><?= h($vehicle->manufacturer) ?></p>
                </div>
                <div class="mb-3 text-center">
                    <strong class="text-black d-block" style="font-size: 20px;">
                        <i class="fa fa-id-card text-primary me-2" style="font-size: 24px;"></i>Registration No:
                    </strong>
                    <p class="text-black" style="font-size: 18px;"><?= h($vehicle->registration_no) ?></p>
                </div>
                <div class="mb-3 text-center">
                    <strong class="text-black d-block" style="font-size: 20px;">
                        <i class="fa fa-paint-brush text-primary me-2" style="font-size: 24px;"></i>Color:
                    </strong>
                    <p class="text-black" style="font-size: 18px;"><?= h($vehicle->color) ?></p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="mb-3 text-center">
                    <strong class="text-black d-block" style="font-size: 20px;">
                        <i class="fa fa-car text-primary me-2" style="font-size: 24px;"></i>Type:
                    </strong>
                    <p class="text-black" style="font-size: 18px;"><?= h(in_array($vehicle->model, ['EX5', 'LC']) ? 'Motorcycle' : 'Car') ?></p>
                </div>
                <div class="mb-3 text-center">
                    <strong class="text-black d-block" style="font-size: 20px;">
                        <i class="fa fa-clock text-primary me-2" style="font-size: 24px;"></i>Rate Per Hour:
                    </strong>
                    <p class="text-black" style="font-size: 18px;"><?= h($vehicle->rate_perhour) ?> /hr</p>
                </div>
                <div class="mb-3 text-center">
                    <strong class="text-black d-block" style="font-size: 20px;">
                        <i class="fa fa-info-circle text-primary me-2" style="font-size: 24px;"></i>Status:
                    </strong>
                    <p class="text-center" style="font-size: 18px;">
                        <?php if ($vehicle->status == 0): ?>
                            <span class="badge bg-warning text-dark">Reserved</span>
                        <?php elseif ($vehicle->status == 1): ?>
                            <span class="badge bg-success">Available</span>
                        <?php elseif ($vehicle->status == 2): ?>
                            <span class="badge bg-danger">Not Available</span>
                        <?php else: ?>
                            <span class="badge bg-primary">In Service</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="text-center mt-4">
    <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-primary rounded-pill px-4">
        <i class="fa-solid fa-arrow-left me-2"></i>Back to Vehicle List
    </a>
    <p class="text-secondary mt-3 small">Fleet Car Rental</p>
</div>
