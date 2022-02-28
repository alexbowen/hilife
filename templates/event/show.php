<ul class="list-group admin">
  <li class="list-group-item"><dl><dt><span>Contact email</span></dt><dd><?php echo $event->prettyField('email'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Primary contact</span></dt><dd><?php echo $event->prettyField('primary_contact'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Secondary contact</span></dt><dd><?php echo $event->prettyField('secondary_contact'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Contact address</span> </dt><dd><?php echo $event->prettyField('client_address'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Contact telephone</span> </dt><dd><?php echo $event->prettyField('client_telephone'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Location</span> </dt><dd><?php echo $event->prettyField('location'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Venue name</span> </dt><dd><?php echo $event->prettyField('venue_name'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Venue address</span> </dt><dd><?php echo $event->prettyField('venue_address'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Number of guests</span> </dt><dd><?php echo $event->prettyField('numbers'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Date</span> </dt><dd><?php echo $event->prettyDate(); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Setup time</span> </dt><dd><?php echo $event->prettyTime('setup'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Start time</span> </dt><dd><?php echo $event->prettyTime('start'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Finish time</span> </dt><dd><?php echo $event->prettyTime('finish'); ?></dd></dl></li>
  <li class="list-group-item"><dl><dt><span>Notes</span> </dt><dd><?php echo $event->prettyField('notes'); ?></dd></dl></li>
</ul>