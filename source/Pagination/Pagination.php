<?php

  class Pagination {
    
    private $url;
    private $total;
    private $totalCount;
    private $perPage;
    private $totalPages;
    private $currentPage;
    private $offset;
    private $dataSet;
    private $links;
    
    public function __construct(array $init)
    {
      $this->url = $init["url"];
      $this->dataSet = $init["dataSet"];
      $this->perPage = (int)$init["perPage"] ?? 10;
      $this->currentPage = (int)$init["currentPage"];
      $this->offset = $this->setOffset();
      $this->totalCount = $this->setCount();
      $this->totalPages = $this->setTotalPages();
      $this->setUrl();
    }
    
    private function setCount() : int
    {
      return count($this->dataSet);
    }
    
    public function getSubsets() : array
    {
      return array_slice($this->dataSet, $this->offset, $this->perPage);
    }
    
    private function setTotalPages()
    {
      return (int)ceil($this->totalCount / $this->perPage);
    }
    
    private function setOffset() : int
    {
      return  $this->perPage * ($this->currentPage - 1);
    }
    
    private function setUrl() : void
    {
      (strpos($this->url, "/?") !== FALSE) ? $this->url .= "&" : $this->url .= "?";
    }
    
    public function getLinks() : string
    { 
      if ($this->currentPage > $this->totalPages) return "";
      $this->links = "<nav aria-label=''>";
      $this->links .= "<ul class='pagination'>";
      
      /** Previous button */
      $disabled = ($this->currentPage == 1 || $this->currentPage > $this->totalPages) ? "disabled" : "";
      $color = (empty($disabled)) ? "text-danger" : "";
      $link = ($this->currentPage > 1) ? $this->url."p=".($this->currentPage - 1) : "";
      $this->links .= "<li class='page-item ".$disabled."'><a class='page-link ".$color."' href='".$link."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
      
      /** First button */
      $active = ($this->currentPage == 1) ? "active" : "";
      $link = (($this->currentPage > 1) && (($this->currentPage < $this->totalPages) || $this->totalPages < 3)) ? $this->url."p=".($this->currentPage - 1) : (($this->currentPage == $this->totalPages) ? $this->url."p=".($this->currentPage - 2) : "#");
      $number = (($this->currentPage > 1) && (($this->currentPage < $this->totalPages) || $this->totalPages < 3)) ? ($this->currentPage - 1) : ((($this->currentPage == $this->totalPages) && ($this->totalPages > 1)) ? ($this->currentPage - 2) : $this->currentPage);
      $this->links .= "<li class='page-item ".$active."'><a class='page-link' href='".$link."'>".$number."</a></li>";
      
      /** Second button */
      if ($this->totalPages > 1) {
        $active = (($this->currentPage > 1) && (($this->currentPage < $this->totalPages) || $this->totalPages < 3)) ? "active" : "";
        $link = (($this->currentPage > 1) && (($this->currentPage < $this->totalPages) || $this->totalPages < 3)) ?  "#" : (($this->currentPage == $this->totalPages) ? $this->url."p=".($this->currentPage - 1) : $this->url."p=".($this->currentPage + 1));
        $number = (($this->currentPage > 1) && (($this->currentPage < $this->totalPages) || $this->totalPages < 3)) ? $this->currentPage : (($this->currentPage == $this->totalPages) ? ($this->currentPage - 1) : ($this->currentPage + 1));
        $this->links .= "<li class='page-item ".$active."'><a class='page-link' href='".$link."'>".$number."</a></li>";
      }
  
      /** Third button */
      if ($this->totalPages > 2) {
        $active = (($this->currentPage > 1) && ($this->currentPage == $this->totalPages)) ? "active" : "";
        $link = (($this->currentPage > 1) && ($this->currentPage < $this->totalPages)) ?  $this->url."p=".($this->currentPage + 1) : (($this->currentPage == $this->totalPages) ?  $this->url."p=".($this->totalPages) : $this->url."p=".($this->currentPage + 2));
        $number = (($this->currentPage > 1) && ($this->currentPage < $this->totalPages)) ? ($this->currentPage + 1) : (($this->currentPage == $this->totalPages) ? $this->totalPages : ($this->currentPage + 2));
        $this->links .= "<li class='page-item ".$active."'><a class='page-link' href='".$link."'>".$number."</a></li>";
      }
        
      /** Next button */
      $disabled = ($this->currentPage == $this->totalPages || $this->currentPage > $this->totalPages) ? "disabled" : "";
      $color = (empty($disabled)) ? "text-danger" : "";
      $link = ($this->currentPage < $this->totalPages) ? $this->url."p=".($this->currentPage + 1) : "";
      $this->links .= "<li class='page-item ".$disabled."'><a class='page-link ".$color."' href='".$link."' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li";
      
      $this->links .= "</ul>";
      $this->links .= "</nav>";
      
      return $this->links;
      
    }
    
  }