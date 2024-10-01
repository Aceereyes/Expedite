<form method = "POST">

								<div class="checkbox">
									<label>
										<input type="checkbox" name = "check_list[]" value = "gg" class="flat"> Edit / Delete students
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name = "check_list[]" value = "g1" class="flat"> Edit / Delete students
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name = "check_list[]" value = "ggs" class="flat"> Edit / Delete students
									</label>
								</div>
								<input type = "submit" name = "submits">
								</form>
								<?php
								if(isset($_POST['submits'])){
									
									foreach($_POST['check_list'] as $selected){
									echo $selected;	
									}
								}
								