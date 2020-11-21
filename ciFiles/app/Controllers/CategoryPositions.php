<?php namespace App\Controllers;

use App\Models\CategoryPositionModel;


class CategoryPositions extends BaseController
{

    private function send_to_login(){

        $session = session();

		$role = $session->get('role');

		if($role!='admin'){
			return redirect()->to(site_url('admin-login')); 
        }

    }

    public function update(){
     
        $this->send_to_login();

        $igfeedcats = $this->request->getPost('ig_feed');
        $igfeedstring = '';
        foreach($igfeedcats as $igfc){
            $igfeedstring.=$igfc.',';
        }
        $homepage = $this->request->getPost('homepage');
        $hpstring = '';
        foreach($homepage as $hpc){
            $hpstring.=$hpc.',';
        }
        $sidenav = $this->request->getPost('sidenav');
        $snstring = '';
        foreach($sidenav as $snc){
            $snstring.=$snc.',';
        }

        $dataToInsert = array(
            'ig_feed' => $igfeedstring,
            'homepage' => $hpstring,
            'sidenav' => $snstring
        );

        $cPosModel = new CategoryPositionModel();

        $updated = $cPosModel->update('1',$dataToInsert);

        return redirect()->to(site_url('category-position-mgt')); 

    }

}