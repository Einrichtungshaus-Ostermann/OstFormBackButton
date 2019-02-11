<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Form Back Button
 *
 * @package   OstFormBackButton
 *
 * @author    Eike Brandt-Warneke <e.brandt-warneke@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstFormBackButton\Listeners\Controllers\Frontend;

use Enlight_Event_EventArgs as EventArgs;
use Shopware_Controllers_Frontend_Forms as Controller;

class Forms
{
    /**
     * ...
     *
     * @var string
     */
    private $viewDir;

    /**
     * ...
     *
     * @param string $viewDir
     */
    public function __construct($viewDir)
    {
        // set params
        $this->viewDir = $viewDir;
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function onPreDispatch(EventArgs $arguments)
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get('subject');

        // get parameters
        $request = $controller->Request();
        $view = $controller->View();

        // only index action
        if (strtolower($request->getActionName()) !== 'index') {
            // nothing to do
            return;
        }

        // add template dir
        $view->addTemplateDir($this->viewDir);
    }

    /**
     * ...
     *
     * @param EventArgs $arguments
     */
    public function onPostDispatch(EventArgs $arguments)
    {
        // get the controller
        /* @var $controller Controller */
        $controller = $arguments->get('subject');

        // get parameters
        $view = $controller->View();
        $request = $controller->Request();

        // only index action
        if (strtolower($request->getActionName()) !== 'index') {
            // nothing to do
            return;
        }

        // do we have a order number set?
        if ($request->has("sOrdernumber")) {
            // set it to form
            $view->assign("sOrdernumber", $request->get("sOrdernumber"));
        }

        // we either have a success message or we jsut called the form
        if ($request->has("success")) {
            // get from session
            $view->assign("sOrdernumber", (string) Shopware()->Session()->offsetGet("ost-form-back-button")['ordernumber']);

            // and remove it
            Shopware()->Session()->offsetUnset("ost-form-back-button");
        }
        else {
            // do we have an ordernumber?
            if ($request->has("sOrdernumber")) {
                // set in session
                Shopware()->Session()->offsetSet("ost-form-back-button", array('ordernumber' => $request->get("sOrdernumber")));
            }
            else {
                // remove it
                Shopware()->Session()->offsetUnset("ost-form-back-button");
            }
        }

        // do we have a order number set?
        if ( !empty( (string) $view->getAssign("sOrdernumber"))) {
            // add article id to create a back url
            $view->assign("dvsnFormBackButtonArticleId", Shopware()->Modules()->Articles()->sGetArticleIdByOrderNumber((string) $view->getAssign("sOrdernumber")));
        }
    }
}
