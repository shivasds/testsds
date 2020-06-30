<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
 	function __construct(){
		/* Session Checking Start*/
		parent::__construct();
		$this->load->model(['Home_model','About_model','Testimonials_model','Common_model']);
		$data['social_media'] = $this->Home_model->get_table_data('social_media'); 
		$this->load->vars($data);

	}
	public function index()
	{
		$where = array("page"=>'home');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$data['content'] = $this->Home_model->get_table_data('page_content',$where);  
		$this->load->view('home',$data);
	}
	public function about()
	{
		$where = array("page"=>'About');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$data['about'] = $this->About_model->get_table_data('about');
		$this->load->view('about',$data);
	}
	public function blog($slug='')
	{
		$blogs = $this->Home_model->order_by('id', 'desc')->getAll('blog');
		if ($blogs && isset($blogs[0])) {
            $this->data['blogs'] = $blogs; 
            $this->load->view('blog', $this->data); 
        } else {
            redirect(site_url());
        }
		//$this->load->view('blog',$data);
	}
	
    public function blog_view($slug = "")
    { 

        $blog = $this->Common_model->getOneWhere(array('slug' => trim($slug)), 'blog'); 
        $this->data['meta'] = $this->Home_model->get_table_data('blog');
        if ($blog) {
            $this->data['next_blog'] = $this->Common_model->getNextBlog($blog->id);
            $this->data['prev_blog'] = $this->Common_model->getPrevBlog($blog->id);
            $this->data['blog'] = $blog;
            
            $this->load->view('blog_navigation', $this->data);
        }  
          else {
            redirect(site_url());
        }
    }
    
	public function contact_us()
	{
		$where = array("page"=>'contact-us');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$this->load->view('contact_us',$data);
	}
	public function request_analysis()
	{
		$where = array("page"=>'request-analysis');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$this->load->view('request_analysis',$data);
	}
	public function seo_services()
	{
		$where = array("page"=>'seo-agency-in-bangalore');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$where = array("page"=>"seo");
        $data['content'] = $this->Common_model->get_table_data("page_content",$where);
		$this->load->view('seo_services',$data);
	} 
	public function smm_services()
	{
		$where = array("page"=>'social-media-agency-in-bangalore');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$where = array("page"=>"smm");
        $data['content'] = $this->Common_model->get_table_data("page_content",$where);
		$this->load->view('smm_services',$data);
	}
	public function web_services()
	{
		$where = array("page"=>'web-development-services-in-bangalore');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$where = array("page"=>"web");
        $data['content'] = $this->Common_model->get_table_data("page_content",$where);
		$this->load->view('web_services',$data);
	}
	public function ppc_services()
	{
		$where = array("page"=>'ppc-company-in-bangalore');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$where = array("page"=>"ppc");
        $data['content'] = $this->Common_model->get_table_data("page_content",$where);
		$this->load->view('ppc_services',$data);
	}
	public function content_services()
	{
		$where = array("page"=>'content-marketing-services');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$where = array("page"=>"content");
        $data['content'] = $this->Common_model->get_table_data("page_content",$where);
		$this->load->view('content_services',$data);
	}
	public function design_services()
	{
		$where = array("page"=>'graphics-designing-company-in-bangalore');
		$data['meta'] = $this->Home_model->get_table_data('meta_tags',$where);
		$data['testimonials'] = $this->Testimonials_model->get_table_data('testimonials');
		$where = array("page"=>"design");
        $data['content'] = $this->Common_model->get_table_data("page_content",$where);
		$this->load->view('design_services',$data);
	}
	public function Contact_mail($page='')
	{ 
			$name = $this->input->post('inputName');
			$phone =  $this->input->post("inputPhone");
			$message = $this->input->post("message");
			$webiste = $this->input->post("website");
			$email = $this->input->post("email");
			$msg = "
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<style>
				table {
				border-collapse: collapse;
				width:100%;
				}

				table, td, th {
				border: 1px solid black;
				}
				</style>
			</head>
			<body>
			<table>
			<tr><th colspan=2>SDS Contact Form</th></tr>
			<tr><td>Name</td><td>$name</td></tr>
			<tr><td>Phone</td><td>$phone</td></tr> 
			<tr><td>message</td><td>$message</td></tr>
			<tr><td>Website</td><td>$webiste</td></tr>
			<tr><td>Email</td><td>$email</td></tr>
			</table>
			</body>
			</html>


			";
		 	 $this->load->library('email');
            
            $this->email->initialize(email_config());

            //$this->email->from("info@secondsdigital.com", "Admin");
            // $this->email->to("shiva@secondsdigital.com,pratyush@secondsdigital.com,info@secondsdigital.com");
            $this->email->to("preetika@secondsdigital.com");
            $this->email->subject("SDS Contact Form Lead");
            $this->email->message($msg);
            $this->email->send();
            redirect("thankyou");
          //  $sent  = $this->email->send();
         //   $page = $this->input->post('post');
       //      if($sent)
       //      {
       //      	$this->session->set_flashdata('success', 'Thankyou For Contacting us We will get back to You soon!');
       //      	if($page=='')
				   // // redirect("contact-us");
				   // $this->load->view('thankyou');
       //          else
       //          {
       //          	redirect($page);
       //          }
       //          } else {
       //              $this->session->set_flashdata('error', 'Failed To sent Message');
       //              redirect( $page);
       //          }
	}
	public function thankyou($value='')
	{
	$this->load->view('thankyou');
	}

	public function career(Type $var = null)
	{
		$this->load->view("Career");
	}
	public function payroll(Type $var = null)
	{
		$this->load->view("payroll-services");
	}

	public function hr(Type $var = null)
	{
		$this->load->view("hr-services");
	}

	public function crm_services(Type $var = null)
	{
		$this->load->view("crm-services");
	}

}
