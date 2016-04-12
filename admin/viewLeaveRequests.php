<div class="row">
	<table class="highlight bordered hoverable">
		<thead>
		  <tr>
		      <th>S.No.</th>
		      <th>Username</th>
		      <th>Leave Type</th>
		      <th>Start Date</th>
		      <th>End Date</th>
		      <th>Grant</th>
		      <th>Reject</th>
		  </tr>
		</thead>

		<tbody>
		<?php

		require_once '../core.php';
		require_once '../user/classDatabaseLeaveRequest.php';

		$objDatabaseLeaveRequest=new DatabaseLeaveRequest;
		$objLeaveRequestArray=$objDatabaseLeaveRequest->getLeaveRequestsWithStatus('Pending');
		if($objLeaveRequestArray) {
			$i=1;
			foreach ($objLeaveRequestArray as $objLeaveRequest) {
				echo '<tr class="request">'.
						'<td>'.$i.'</td>'.
						'<td>'.$objLeaveRequest->getUsername().'</td>'.
						'<td>'.$objLeaveRequest->getLeaveType().'</td>'.
						'<td>'.$objLeaveRequest->getStartDate().'</td>'.
						'<td>'.$objLeaveRequest->getEndDate().'</td>'.
						'<td><a href="grant.php?id='.$objLeaveRequest->getid().'"><i class="material-icons grant">done_all</i></a></td>'.
						'<td><a href="reject.php?id='.$objLeaveRequest->getid().'"><i class="material-icons reject">delete</i></a></td>'.
					'</tr>'.
					'<tr class="reason">'.
						'<td colspan="6"><div><b>Reason:</b><br>'.$objLeaveRequest->getReason().'</div><td>'.
					'</tr>';
				$i++;
			}
		} else {
			setError('No new Leave Requests :)');
		}

		?>
		</tbody>
	</table>
</div>

<style type="text/css">
	.grant:hover {
		color: green;
	}
	.reject:hover {
		color: red;
	}
	.reason {
		display: none;
	}
	.reason td {
		padding-top: 0;
		padding-bottom: 0;
	}
	.request:hover + .reason, .hoverColor {
		background-color: #f2f2f2;
	}
</style>

<script type="text/javascript">
	var border = $('.request').css("border-bottom");
	var delay = 500;
	var activeElement = null;
	var hoverElem = null;
	var timeout = null;

	$(document).mousemove(function(event) {
		clearTimeout(timeout);

		timeout = setTimeout(function() {
			hoverElem = jQuery(document.elementFromPoint(event.clientX, event.clientY)).closest('tr');
			if(activeElement!=null && !activeElement.is(hoverElem) && !activeElement.next().is(hoverElem)) {
				var temp = activeElement;
				activeElement = null;
				temp.next().find('div').slideUp(delay, function(){
					temp.next().hide();
					temp.css("border-bottom",border);
				});	
	    	}
	    	if(hoverElem.attr('class')=='request' && hoverElem.next().css('display')!='table-row') {
	    		activeElement = hoverElem;
				hoverElem.next().find('div').css('display','none');
		        hoverElem.next().css('display','table-row').find('div').slideDown(delay);
				hoverElem.css("border-bottom","transparent");
	    	}
	    }, 100, event);
	});

	// $('.request').hover(function() {
	// 	prevHover = $(this);
	// 	if(!$(this).next().is(prevHover)) {
	// 		$(this).next().find('div').css('display','none');
	//         $(this).next().css('display','table-row').find('div').slideDown(delay);
	// 		$(this).css("border-bottom","transparent");
	// 	}
	// }, function() {
	// 	if(!$(this).next().is(':hover')) {
	// 		prevHover = null;
	// 		$(this).next().find('div').slideUp(delay, function(){
	// 			$(this).next().hide();
	// 			$(this).css("border-bottom",border);
	// 		});
	// 	}
	// });

	// $('.reason').hover(function() {
	// 	prevHover = $(this);
	// }, function() {
	// 	if(!$(this).prev().is(':hover')) {
	// 		prevHover = null;
	// 		$(this).find('div').slideUp(delay, function(){
	// 			$(this).hide();
	// 			$(this).prev().css("border-bottom",border);
	// 		});
	// 	}
	// });

	$('.reason').hover(function(){
		$(this).prev().toggleClass('hoverColor');
	});
</script>