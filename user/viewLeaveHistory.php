<div class="row">
	<table class="highlight bordered hoverable">
		<thead>
		  <tr>
		      <th>S.No.</th>
		      <th>Leave Type</th>
		      <th>Start Date</th>
		      <th>End Date</th>
		      <th>Status</th>
		  </tr>
		</thead>

		<tbody>
		<?php

		require_once '../core.php';
		require_once 'classDatabaseLeaveRequest.php';

		$objDatabaseLeaveRequest=new DatabaseLeaveRequest;
		$objLeaveRequestArray=$objDatabaseLeaveRequest->getLeaveRequests();
		if($objLeaveRequestArray) {
			$i=1;
			foreach ($objLeaveRequestArray as $objLeaveRequest) {
				if($objLeaveRequest->getUsername()==getUsername()) {
					echo '<tr class="request">'.
							'<td>'.$i.'</td>'.
							'<td>'.$objLeaveRequest->getLeaveType().'</td>'.
							'<td>'.$objLeaveRequest->getStartDate().'</td>'.
							'<td>'.$objLeaveRequest->getEndDate().'</td>'.
							'<td>'.$objLeaveRequest->getStatus().'</td>'.
						'</tr>'.
					'<tr class="reason">'.
						'<td colspan="4"><div><b>Reason:</b><br>'.$objLeaveRequest->getReason().'</div><td>'.
					'</tr>';
					$i++;
				}
			}
			if($i==1) {
				setError('You have not requested any leave.');	
			}
		} else {
			setError('No LeaveRequest has been created yet.');
		}

		?>
		</tbody>
	</table>
</div>

<style type="text/css">
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

	$('.reason').hover(function(){
		$(this).prev().toggleClass('hoverColor');
	});
</script>