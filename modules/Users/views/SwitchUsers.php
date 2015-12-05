<?php

/**
 * @package YetiForce.Modal
 * @license licenses/License.html
 * @author Radosław Skrzypczak <r.skrzypczak@yetiforce.com>
 */
class Users_SwitchUsers_View extends Vtiger_BasicModal_View
{

	public function preProcess(Vtiger_Request $request)
	{
		echo '<div class="modal fade switchUsersContainer"><div class="modal-dialog modal-sm"><div class="modal-content">';
	}

	public function process(Vtiger_Request $request)
	{
		$moduleName = $request->getModule();
		$users = Users_Module_Model::getSwitchUsers();
		$userId = $request->get('id');
		$baseUserId = $userId;
		if (Vtiger_Session::has('baseUserId')) {
			$baseUserId = Vtiger_Session::get('baseUserId');
		}
		unset($users[$baseUserId]);
		unset($users[$userId]);
		$viewer = $this->getViewer($request);
		$viewer->assign('SWITCH_USERS', $users);
		$viewer->assign('MODULE_NAME', $moduleName);
		$viewer->assign('BASE_USER_ID', $baseUserId);
		$this->preProcess($request);
		$viewer->view('SwitchUsers.tpl', $moduleName);
		$this->postProcess($request);
		$log->debug('Exiting ' . __CLASS__ . '::' . __METHOD__ . ' method ...');
	}
}
