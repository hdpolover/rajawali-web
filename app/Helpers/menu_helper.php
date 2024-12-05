<?php
// app/Helpers/menu_helper.php

if (!function_exists('renderMenu')) {
    function renderMenu($items)
    {
        $currentUrl = current_url();
        $html = '<ul class="menu">';
        
        foreach ($items as $item) {
            $isActive = strpos($currentUrl, site_url($item->url)) !== false;
            
            if (count($item->children) > 0) {
                $html .= '<li class="sidebar-item has-sub ' . ($isActive ? 'active' : '') . '">
                            <a href="' . site_url($item->url) . '" class="sidebar-link">
                                <i class="' . $item->icon . '"></i>
                                <span>' . $item->title . '</span>
                            </a>
                            <ul class="submenu ' . ($isActive ? 'active' : '') . '">';
                            
                foreach ($item->children as $child) {
                    $isChildActive = strpos($currentUrl, site_url($child->url)) !== false;
                    $html .= '<li class="submenu-item ' . ($isChildActive ? 'active' : '') . '">
                                <a href="' . site_url($child->url) . '" class="submenu-link">' . $child->title . '</a>
                            </li>';
                }
                $html .= '</ul></li>';
            } else {
                $html .= '<li class="sidebar-item ' . ($isActive ? 'active' : '') . '">
                            <a href="' . site_url($item->url) . '" class="sidebar-link">
                                <i class="' . $item->icon . '"></i>
                                <span>' . $item->title . '</span>
                            </a>
                        </li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}