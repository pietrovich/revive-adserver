<?php

require_once(MAX_PATH.'/lib/OA/Upgrade/Migration.php');

class Migration_323 extends Migration
{

    function Migration_323()
    {
        //$this->__construct();

		$this->aTaskList_constructive[] = 'beforeAddField__affiliates__comments';
		$this->aTaskList_constructive[] = 'afterAddField__affiliates__comments';
		$this->aTaskList_constructive[] = 'beforeAddField__affiliates__last_accepted_agency_agreement';
		$this->aTaskList_constructive[] = 'afterAddField__affiliates__last_accepted_agency_agreement';
		$this->aTaskList_constructive[] = 'beforeAddField__affiliates__updated';
		$this->aTaskList_constructive[] = 'afterAddField__affiliates__updated';


		$this->aObjectMap['affiliates']['comments'] = array('fromTable'=>'affiliates', 'fromField'=>'comments');
		$this->aObjectMap['affiliates']['last_accepted_agency_agreement'] = array('fromTable'=>'affiliates', 'fromField'=>'last_accepted_agency_agreement');
		$this->aObjectMap['affiliates']['updated'] = array('fromTable'=>'affiliates', 'fromField'=>'updated');
    }



	function beforeAddField__affiliates__comments()
	{
		return $this->beforeAddField('affiliates', 'comments');
	}

	function afterAddField__affiliates__comments()
	{
		return $this->afterAddField('affiliates', 'comments');
	}

	function beforeAddField__affiliates__last_accepted_agency_agreement()
	{
		return $this->beforeAddField('affiliates', 'last_accepted_agency_agreement');
	}

	function afterAddField__affiliates__last_accepted_agency_agreement()
	{
		return $this->afterAddField('affiliates', 'last_accepted_agency_agreement');
	}

	function beforeAddField__affiliates__updated()
	{
		return $this->beforeAddField('affiliates', 'updated');
	}

	function afterAddField__affiliates__updated()
	{
		return $this->afterAddField('affiliates', 'updated');
	}

}

?>