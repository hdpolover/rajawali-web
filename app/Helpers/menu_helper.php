<?php
// app/Helpers/menu_helper.php

if (!function_exists('renderMenu')) {
    function renderMenu($items)
    {
        $currentUrl = current_url();
        $html = '<ul class="menu">';
        
        foreach ($items as $index => $item) {
            $hasSubmenu = count($item->children) > 0;
            $isActive = strpos($currentUrl, site_url($item->url)) !== false;
            $html .= '<li class="sidebar-item' . ($hasSubmenu ? ' has-sub' : '') . ($isActive ? ' active' : '') . '" data-menu-id="' . $index . '">
                        <a href="' . site_url($item->url) . '" class="sidebar-link">
                            <i class="' . $item->icon . '"></i>
                            <span>' . $item->title . '</span>
                        </a>';
            
            if ($hasSubmenu) {
                $html .= '<ul class="submenu">';
                
                foreach ($item->children as $childIndex => $child) {
                    $isChildActive = strpos($currentUrl, site_url($child->url)) !== false;
                    if ($isChildActive) {
                        $isActive = true;
                    }
                    $html .= '<li class="submenu-item' . ($isChildActive ? ' active' : '') . '">
                                <a href="' . site_url($child->url) . '" class="submenu-link">' . $child->title . '</a>
                            </li>';
                }
                
                $html .= '</ul>';
            }
            
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        return $html;
    }
}