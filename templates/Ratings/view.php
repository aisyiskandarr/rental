<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rating $rating
 */
?>
<!--Header-->
<div class="header mb-4">
    <div class="row align-items-center">
        <div class="col-10">
            <h1 class="my-0 page_title"><i class="fa-solid fa-star"></i> <?= h($title); ?></h1>
            <h6 class="sub_title text-light"><?= h($system_name); ?></h6>
        </div>
        
        <div class="col-2 text-end">
            <div class="dropdown mx-3 mt-2">
                <button class="btn p-0 border-0" type="button" id="orderStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-bars text-primary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orderStatistics">
                    <?= $this->Html->image('../files/vehicles/image/' . $rating->vehicle->image, ['style' => 'width: 400px; height: auto;']); ?>
                    <li><?= $this->Html->link(__('Edit Rating'), ['action' => 'edit', $rating->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                    <li><?= $this->Form->postLink(__('Delete Rating'), ['action' => 'delete', $rating->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><?= $this->Html->link(__('List Ratings'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                    <li><?= $this->Html->link(__('New Rating'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
    <div class="col-md-12">
        <div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
            <div class="card text-center">
            <?php echo $this->Html->image('../files/vehicles/image/' . $rating->vehicle->image, ['class'=> 'img-center','style' => 'width: 400px; height: auto;']); ?>
                <div class="container p-3">
                    <h4><b><?= h($rating->vehicle->model); ?></b></h4>
                </div>
            </div>
            <div class="card-body">
                <h3 class="text-primary">Rating: <?= h($rating->rate); ?></h3>
                <div class="star-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" style="color: <?= $rating->rate >= $i ? '#FFD43B' : '#d3d3d3'; ?>;">&#9733;</span>
                    <?php endfor; ?>
                </div>

                <p class="mt-3">Comment: <?= h($rating->comment); ?></p>

                <div class="mt-3">
                    <table class="table table-borderless">
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?=($rating->user->fullname); ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Progress Bar -->
                <div class="progress mt-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $rating->rate * 20; ?>%;" aria-valuenow="<?= $rating->rate; ?>" aria-valuemin="0" aria-valuemax="5">
                        <?= $rating->rate * 20; ?>%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
    .header {
        background: linear-gradient(90deg, rgb(37, 37, 37), rgb(56, 56, 56));
        color: #fff;
        padding: 10px;
        border-radius: 5px;
    }

    .card {
        border-radius: 8px;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
    }

    .img-center{
        max-width: 100%;
        border-radius: 10px;
        height: auto;
        align: center;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(80, 78, 78, 0.1);
    }

    .card-img-top {
        border-radius: 8px 8px 0 0;
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .star-rating {
        font-size: 2.5rem;
        user-select: none;
    }

    .star {
        transition: color 0.3s;
    }

    .progress {
        height: 25px;
        border-radius: 15px;
    }

    .progress-bar {
        text-align: center;
        font-size: 0.9rem;
    }

    .table {
        margin-top: 3rem;
    }

    .table th {
        width: 50%;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .text-muted {
        font-size: 0.9rem;
    }
</style>
