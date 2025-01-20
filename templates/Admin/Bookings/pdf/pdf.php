<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Booking</title>
    
    <style>
        @page{
            margin: 0px !important;
            padding: 0px !important;
        }

        body {
            font-family:Arial, Helvetica, sans-serif;
            font-size: 15px;
        }

        .right{
            text-align: right;
            padding-right: 50px;
        }

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

        .content{
            margin-left: 70px;
            margin-right: 70px;
        }

        .center-logo {
            text-align: center;
            margin:20px 0;
        }

        .text-end {
            text-align: end;
        }

        .table-hover {
            width: 80%;
            margin: auto;
        }

        .table-dark {
        background-color: #343a40;
        color: #fff;
        }

        .table-center {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="row">
	<div class="col-md-9">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">

                    <section class="top">
                        <div class="one"></div>
                        <div class="two"></div>
                    </section>

        <div class="center-logo">
            <?php echo $this ->Html-> image('../img/rental.png', ['width'=>'150px', 'fullBase'=>true])?>
            <h2 style="text-align:center">BOOKING CONFIRMATION SLIP</h2>
        </div>

<div class="content">
        <hr />        <div class="row">
        
        <div class="col-md-8">
        <div class="card-title md-0 mt-3"><b>Booking Details</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Booked by</b></div>


        <p><b><?= __('Start Date') ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($booking->start_date) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= ($booking->user->fullname) ?>

    </br><b><?= __('End Date') ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($booking->end_date) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($booking->user->email) ?>
</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= h($booking->nric) ?>
        </div>
    
        
    
    
    <div class="col-md-4">
    <table>
        <tr>
            <td width="70%"class="text-start"><b>Model</b></td>
            <td>&nbsp;&nbsp;&nbsp;<?= h($booking->vehicle->model)?></td>
        </tr>
        <tr>
            <td width="70%"class="text-start"><b>Booking Date</b></td>
            <td>&nbsp;&nbsp;&nbsp;<?= h($booking->booking_date)?></td>
        </tr>
        <tr>
            <td width="70%"class="text-start"><b>Status</b></td>
            <td>&nbsp;&nbsp;
                    <?php if ($booking -> status == 0) {
                        echo '<span class= "badge bg-success">Approved</span>';
                    } elseif ($booking -> status == 1) {
                        echo '<span class= "badge bg-warning">Pending</span>';
                    } elseif ($booking -> status == 2) {
                        echo '<span class= "badge bg-danger">Rejected</span>';
                    } else
                        echo '<span class= "badge bg-danger">Error</span>';
                    ?>
            </td>
        </tr>

    </table>
    </div>     
    </div>

    <br/><b>&nbsp;&nbsp;&nbsp;&nbsp;<div class="card-title md-0 mt-3" text-aligh="right">License</div></b>
            <div class="col-md-4" width="320px">
            <?php echo $this->Html->image('../files/bookings/license/' . $booking->license, ['class' => 'rounded', 'width' => '20%', 'height' => '80px', 'fullBase'=>true]); ?>
            </div>
        </div>

</table>
        <br /> <br/><br/>
<div class="content">
        <table class="table table-hover mx-auto">
            <thead class="table-dark">
                <tr>
                <th scope="col" class="text-center">NO.</th>
                <th scope="col" class="text-center">VEHICLE</th>
                <th scope="col" class="text-center">HOURS</th>
                <th scope="col" class="text-center">RATE</th>
                <th scope="col" class="text-end">TOTAL AMOUNT</th>
                </tr>
            </thead>
            <tbody class="table-center">
                <tr>
                <td class="text-center"><?= ($booking->id)?></td>
                <td class="text-center"><?=($booking->vehicle->model)?></td>
                <td class="text-center"><?= ($booking->hours) ?></td>
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

    3.  &nbsp; The RENTER must ensure that the fuel level of the vehicle is the same as when it was received and ensure the vehicle is clean.<br/><br/>

    4.  &nbsp;  The vehicle is prohibited from being used for any criminal activities or carrying illegal items. <br/><br/><br/>

    <b>RENTER'S AGREEMENT : </b><br/><br />
    I'm <?= ($booking->user->fullname) ?>, with Identification Number <?= h($booking->nric) ?>, have read and understood the terms of the Vehicle Rental Agreement. I agree to follow all the terms stated in this agreement as of the date <?= h($booking->booking_date)?>. I promise to comply with all the terms stated. If I fail to fulfill any of the above terms, legal action may be taken against me.
    <br/>
</div></div>
<br />

    
        
            </div>

			</div>
		</div>
		

	</div>
</div>
</body>
</html>