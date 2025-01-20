<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
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
							<li><?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">
            
                <style>
                    .top {
                        width: 100%;
                        margin: auto; 
                    }

                    .one{
                        width:70%;
                        height: 25px;
                        background-color:rgb(101, 101, 218);
                        float: left;
                    }

                    .two{
                        margin-left: 15%;
                        height: 25px;
                        background:rgb(0, 0, 0);
                    }
                </style>

                    <section class="top">
                        <div class="one"></div>
                        <div class="two"></div>
                    </section>

        <div class="text-center">
            <?php echo $this ->Html-> image('../img/rental.png', ['width'=>'180px'])?>
            <h4>BOOKING CONFIRMATION SLIP</h4>
        </div>

        <hr />
            <div class="row">
            
                <div class="col-md-8">
                <div class="card-title md-0 mt-3">Booking Details</div>
            <?= __('Start Date') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($booking->start_date) ?>
            </br><?= __('End Date') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($booking->end_date) ?>
                </div>
            
                <div class="col-md-4">
                <div class="card-title md-0 mt-3">License</div>
                <?php echo $this->Html->image('../files/bookings/license/' . $booking->license, ['class' => 'rounded', 'width' => '60%', 'height' => '80px']); ?>
                </div>
            </div>
            
            
            
            <div class="row">
            <div class="card-title md-0 mt-3">Booked by</div>
            <div class="col-md-8">
            <?= ($booking->user->fullname) ?>
            </br><?= h($booking->user->email) ?>
            </br><?= h($booking->nric) ?>
            </div>
            <div class="col-md-4">
            <table>
                <tr>
                    <td width="70%"class="text-start"><b>Model</b></td>
                    <td><?= h($booking->vehicle->model)?></td>
                </tr>
                <tr>
                    <td width="70%"class="text-start"><b>Booking Date</b></td>
                    <td><?= h($booking->booking_date)?></td>
                </tr>
                <tr>
                    <td width="70%"class="text-start"><b>Status</b></td>
                    <td>
                            <?php if ($booking -> status == 0) {
                                echo '<span class= "badge bg-success">Approved</span>';
                            } elseif ($booking -> status == 1) {
                                echo '<span class= "badge bg-warning">Pending</span>';
                            } elseif ($booking -> status == 2) {
                                echo '<span class= "badge bg-danger">Rejected</span>';
                            } else
                                echo '<span class= "badge bg-danger">Errors</span>';
                            ?>
                    </td>
                </tr>

            </table>
            </div>     
            </div>
        </table>
        <br /> <br/><br/>
        <table class="table table-hover mx-auto" style="width:80%">
    <thead class="table-dark">
        <tr>
        <th scope="col" class="text-center">NO.</th>
        <th scope="col" class="text-center">VEHICLE</th>
        <th scope="col" class="text-center">HOURS</th>
        <th scope="col" class="text-center">RATE</th>
        <th scope="col" class="text-end">TOTAL AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td class="text-center"><?= $this->Number->format($booking->id) ?></td>
        <td class="text-center"><?=($booking->vehicle->model)?></td>
        <td class="text-center"><?= $this->Number->format($booking->hours) ?></td>
        <td class="text-center"><?= ($booking->vehicle->rate_perhour) ?></td>
        <td class="text-end"><?= h($booking->total_amount) ?></td>
        </tr>
        
    </tbody>
    </table>
    <br/>

    <hr />

    <div class = "justify">
    <br/><b>TERMS & CONDITIONS </b><br/><br/>

    1. &nbsp; Full payment must be made before using the vehicle.<br/><br/>

    2.  &nbsp; The RENTER is fully responsible for all parking fees and traffic fines during the rental period. In the case of <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;damage, accident, or theft, the RENTER must cover all costs incurred by the OWNER related to the vehicle.<br/><br/>

    3.  &nbsp; The RENTER must ensure that the fuel level of the vehicle is the same as when it was received and ensure the<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; vehicle is clean.<br/><br/>

    4.  &nbsp;  The vehicle is prohibited from being used for any criminal activities or carrying illegal items. <br/><br/>

    <b>RENTER'S AGREEMENT : </b><br/><br/>
    I'm <?= ($booking->user->fullname) ?>, with Identification Number <?= h($booking->nric) ?>, have read and understood the terms of the Vehicle Rental Agreement. I agree to follow all the terms stated in this agreement as of the date <?= h($booking->booking_date)?>. I promise to comply with all the terms stated. If I fail to fulfill any of the above terms, legal action may be taken against me.
    <br/>

<br /><br />

    
        
            </div>

			</div>
		</div>
		

	</div>
	<div class="col-md-3">
	  <div class="card bg-body-tertiary border-0 shadow">
        <div class="card-body">
            <div class="card-title mb-0">Booking Management</div>
            <div class="tricolor_line mb-3"></div>
            <table class ="table table-sm table-hover">
                <tr>
                    <td width="35%">Date</td>

                    <td><?php echo date('M d, Y (h:i A)', strtotime($booking->booking_date)); ?></td>
                </tr>
                <tr>
                    <td>Booking Status</td>
                    <td width="15%"class="text-end"><?php if ($booking -> status == 0) {
                                echo '<span class= "badge bg-success">Approved</span>';
                            } elseif ($booking -> status == 1) {
                                echo '<span class= "badge bg-warning">Pending</span>';
                            } elseif ($booking -> status == 2) {
                                echo '<span class= "badge bg-danger">Rejected</span>';
                            } else
                                echo '<span class= "badge bg-danger">Errors</span>';
                            ?>
                    </td>
                </tr>
            </table>
            <?php if ($booking->status == 0) : // Approved ?>
    <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
            <div class="fw-semibold">Pending Booking</div>
            <p class="mb-0">Are you sure you want to mark <?= h($booking->user->fullname) ?> booking as pending?</p>
            <div class="text-end mb-2">
                <?= $this->Form->postLink(
                    __('Mark as Pending'),
                    ['action' => 'changeStatus', $booking->id, 1],
                    [
                        'confirm' => __('Are you sure you want to mark user: "{0}" as pending?', $booking->user->fullname),
                        'title' => __('Mark as Pending'),
                        'class' => 'btn btn-warning btn-xs',
                        'escapeTitle' => false,
                        'data-bs-toggle' => "modal",
                        'data-bs-target' => "#bootstrapModal"
                    ]
                ) ?>
            </div>
        </div>
    </div>

<?php elseif ($booking->status == 1) : // Pending ?>
    <div class="mb-3 col-12 mb-0">
        <div class="alert alert-info">
            <div class="fw-semibold">Approve booking</div>
            <p class="mb-0">Are you sure you want to approve <?= h($booking->user->fullname) ?> booking?</p>
            <div class="text-end">
                <?= $this->Form->postLink(
                    __('Approve'),
                    ['action' => 'changeStatus', $booking->id, 0],
                    [
                        'confirm' => __('Are you sure you want to approve user: "{0}"?', $booking->user->fullname),
                        'title' => __('Approve'),
                        'class' => 'btn btn-success btn-xs',
                        'escapeTitle' => false,
                        'data-bs-toggle' => "modal",
                        'data-bs-target' => "#bootstrapModal"
                    ]
                ) ?>
            </div>
        </div>
    </div>
    <div class="mb-3 col-12 mb-0">
        <div class="alert alert-danger">
            <div class="fw-semibold">Reject Booking</div>
            <p class="mb-0">Are you sure you want to reject <?= h($booking->user->fullname) ?> booking?</p>
            <div class="text-end">
                <?= $this->Form->postLink(
                    __('Reject'),
                    ['action' => 'changeStatus', $booking->id, 2],
                    [
                        'confirm' => __('Are you sure you want to reject user: "{0}"?', $booking->user->fullname),
                        'title' => __('Reject'),
                        'class' => 'btn btn-danger btn-xs',
                        'escapeTitle' => false,
                        'data-bs-toggle' => "modal",
                        'data-bs-target' => "#bootstrapModal"
                    ]
                ) ?>
            </div>
        </div>
    </div>

<?php elseif ($booking->status == 2) :  ?>
    <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
            <div class="fw-semibold">Pending Booking</div>
            <p class="mb-0">Are you sure you want to mark <?= h($booking->user->fullname) ?> booking as pending?</p>
            <div class="text-end">
                <?= $this->Form->postLink(
                    __('Mark as Pending'),
                    ['action' => 'changeStatus', $booking->id, 1],
                    [
                        'confirm' => __('Are you sure you want to mark user: "{0}" as pending?', $booking->user->fullname),
                        'title' => __('Mark as Pending'),
                        'class' => 'btn btn-warning btn-xs',
                        'escapeTitle' => false,
                        'data-bs-toggle' => "modal",
                        'data-bs-target' => "#bootstrapModal"
                    ]
                ) ?>
            </div>
        </div>
    </div>
<?php endif; ?>

            <?php echo $this->Html->link(('Download PDF'),['action'=>'pdf', $booking->id], ['class'=>'btn btn-sm btn-outline-danger', 'escapeTitle' => false]); ?>
        </div>
      </div>
	</div>
</div>




