

    <?php
    class thickboxHelper extends AppHelper {
     
        var $helpers = array('Javascript', 'Html');
       
        /**
         * Set properties - DOM ID, Height and Width, Type of thickbox window - inline or ajax
         *
         * @param array $options
         */
        function setProperties($options = array())
        {
            if(!isset($options['type']))
            {
                $options['type'] = 'inline';
            }
            $this->options = $options;
        }
       
        function setPreviewContent($content)
        {
            $this->options['previewContent'] = $content;
        }
     
        function setMainContent($content)
        {
            $this->options['mainContent'] = $content;
        }
       
        function reset()
        {
            $this->options = array();
        }
       
        function output()
        {
            extract($this->options);
            if($type=='inline')
            {
                $href = '?';
               // $href .= '&inlineId='.$id;
                //$href .= $id;
            }
            elseif($type=='ajax')
            {
                $ajaxUrl = $this->Html->url($ajaxUrl);
                $href = $ajaxUrl.'?';
            }
                   
            if(isset($height))
            {
                $href .= 'height='.$height;
            }
            if(isset($width))
            {
                $href .= '&width='.$width;
            }
           
           
            $output = '<a class="thickbox" href="'.$href.'">'.$previewContent.'</a>';
           
            if($type=='inline')
            {
                $output .= '<div  style="display:none;">'.$mainContent.'</div>';
            }
           
            unset($this->options);
           
            return $output;
        }
       
        function beforeRender()
        {
            $out = $this->Html->css('thickbox.css').'<script src="'.$this->Html->url('thickbox.js').'"></script>';
            $view =& ClassRegistry::getObject('view');
            $view->addScript($out);
        }
     
    }
    ?>

