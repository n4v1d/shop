<?php
// Turn off all error reporting
error_reporting(0);
session_start();
require 'autoload.php';

$uid = $_SESSION['UserId'];
$content = file_get_contents("php://input");
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


$logreport = new logreport();
$logreport->NewLogReport($uid,$content,$link);


if(!isset($_SESSION['UserId']))
{
echo 'لطفا مجددا وارد شوید';
exit;
}


require 'function/factor.php'; // Require factor Section
require 'function/archive.php'; // Require archive Section
require 'function/calender.php'; // Require calender Section
require 'function/chart.php'; // Require chart Section
require 'function/check.php'; // Require check Section
require 'function/company.php'; // Require company Section
require 'function/entity.php'; // Require entity Section
require 'function/manager.php'; // Require manager Section
require 'function/message.php'; // Require message Section
require 'function/mojodi.php'; // Require mojodi Section
require 'function/product.php'; // Require product Section
require 'function/recipet.php'; // Require recipet Section
require 'function/report.php'; // Require report Section
require 'function/user.php'; // Require user Section



$manager = new manager();
$page = $_POST['page'];


switch ($page)
{
    case "newFactor":
        newfactor();
        break;
        case "PriceReport":
            PriceReport();
        break;
        case "ViewProductReport":
            ViewProductReport();
        break;

    case "newFactorForm":
        newfactorForm();
        break;
    case "createFactor":
        createFactor();
        break;
    case "factorList":
        factorlist();
        break;
        case "CompanyfactorList":
        Companyfactorlist();
        break;

    case "viewFactor":
        viewFactor();
        break;

    case "viewBranchFactor":
        viewBranchFactor();
        break;

    case "SearchProduct":
        SearchProduct();
        break;
    case "add2factor":
        add2factor();
        break;
    case "company":
        company();
        break;
    case "createCompany":
        Createcompany();
        break;
    case "Product":
        product();
        break;
    case "createProduct":
        CreateProduct();
        break;
    case "companySearch":
        companySearch();
        break;

    case "productSearch":
        productSearch();
        break;
    case "getFactorEntery":
    getFactorEntery();
        break;
 case "deleteEntity":
     deleteEntity();
        break;
    case "editEntity":
        editEntity();
        break;
    case "editEntitySave":
        editEntitySave();
        break;
        case "report":
        report();
        break;
        case "ShowFactorList":
            ShowFactorList();
        break;
         case "chart":
            chart();
        break;
     case "getProductGraph":
         getProductGraph();
        break;
    case "recipet":
        recipet();
        break;

  case "searchRecipet":
      searchRecipet();
        break;
        case "newRecipet":
            newRecipet();
        break;
        case "saveNewRecipet":
            saveNewRecipet();
        break;
        case "GetEshantionName":
            GetEshantionName();
        break;
        case "unaccept":
            unaccept();
        break;
        case "problem":
            problem();
        break;
       case "discount":
            discount();
        break;


    case "check":
        check();
        break;
    case "CalcCheck":
        CalcCheck();
        break;

  case "Detailed":
      Detailed();
        break;



  case "accepted":
      accepted();
        break;
  case "awaiting":
      awaiting();
        break;


        case "open":
      open();
        break;



  case "archive":
      archive();
        break;
  case "ShowFactorListByFactorid":
      ShowFactorListByFactorid();
        break;

  case "ShowFactorListByFactorid":
      ShowFactorListByFactorid();
        break;



  case "BuyReport":
      BuyReport();
        break;

  case "ShowBuyReport":
      ShowBuyReport();
        break;

  case "ByStatus":
      ByStatus();
        break;

 case "ShowByStatus":
     ShowByStatus();
        break;

 case "Message":
     Message();
        break;

 case "SaveFactorFinal":
     SaveFactorFinal();
        break;
        case "Manager":
            Manager();
        break;
        case "UserArchiveGet":
            UserArchiveGet();
        break;
     case "RankUpdate":
            RankUpdate();
        break;
     case "AdminPanel":
            AdminPanel();
        break;
     case "scoreCalc":
            scoreCalc();
        break;
        case "SeeReport":
            ShowReport();
        break;

  case "Discount":
      Discount();
        break;


  case "EditFactor":
      EditFactor();
        break;

  case "EdintEntitySave":
      EdintEntitySave();
        break;


  case "BuyCount":
      BuyCount();
        break;


  case "CalculateBuy":
      CalculateBuy();
        break;

  case "DetailedReport":
      DetailedReport();
        break;

  case "GetLastBuyData":
      GetLastBuyData();
        break;

  case "entity_company":
      entity_company();
        break;


  case "entity_company_product":
      entity_company_product();
        break;


  case "entity_company_addproduct":
      entity_company_addproduct();
        break;

  case "entity_product":
      entity_product();
        break;

  case "entity_product_relation":
      entity_product_relation();
        break;



  case "inventory":
      inventory();
        break;



        //  Open Close Factor Place

        case "ChangeStatus":

            ChangeStatus();

            break;

            case "OpenFactor":

            OpenFactor();

            break;


            case "CloseFactore":

            CloseFactore();

            break;


            case "ProductLIst":

            ProductList();

            break;

            case "CompanyList":

            CompanyList();

            break;


            /// Calender Place


            case "calender":

            calender();

            break;


            case "saveMessage":

            saveMessage();

            break;

            case "UpdateCalenderMessage":

            UpdateCalenderMessage();

            break;

                        // Change Password


            case "changePass":

            changePass();

            break;

            case "ChangePassSave":

            ChangePassSave();

            break;



            case "ConfirmCheck":

            ConfirmCheck();

            break;




            case "SaveCheckLength":

            SaveCheckLength();

            break;




            case "SaveCheckLengthFinal":

                SaveCheckLengthFinal();

            break;




            case "CalenderCheck":

            CalenderCheck();

            break;




            case "UpdateCalenderCheckMessage":

            UpdateCalenderCheckMessage();

            break;


            //Factor Messages

            case "AddFactorMessage":

                AddFactorMessage();

            break;


            case "awaitingCheck":

                awaitingCheck();

            break;

            case "GetUserFactorDetail":

                GetUserFactorDetail();

            break;




}









?>