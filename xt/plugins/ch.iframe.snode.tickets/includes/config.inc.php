<?php
// Set the base id
XT::setBaseID(8100);

// Set tables
XT::addTable('tickets');
XT::addTable('tickets_history');
XT::addTable('addresses');
XT::addTable('user');
XT::addTable('user_roles');
XT::addTable('countries');
XT::addTable('tickets_tmp_data');


// Set tabs
XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('addTicket','Add ticket','addTicket.php',false,false);
XT::addTab('pool','Ticket-Pool','pool.php',false,true);
XT::addTab('myTickets','My tickets','myTickets.php',false,true);
XT::addTab('oldTickets','My old tickets','oldTickets.php',false,true);
XT::addTab('edit','Edit Ticket','edit.php',false,false);
XT::addTab('accounting','Accounting','accounting.php',false,true);
XT::addTab('slave1','Slave1','slave1.php',false,false);

$priority = array(0 => "No priority", 1 => "Low", 2=> "Average", 3 => "High");
XT::addConfig('priorities', $priority);

// set the id of the role which collects all employees. Default is 1 (Superusers)
XT::addConfig('admin_role', 1);

// Set the id of the default supervisor. All Tickets from clients are automaticaly assigned to this user as running ticket.
// If you set 0, all new tickets from client are assigned to the pool.
XT::addConfig('auto_supervisor', 0);
// Permissions
XT::enablePermissions();
?>