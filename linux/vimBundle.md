如果你的Linux系统上还没有Git

mkdir -p ~/.vim/bundle 

git clone https://github.com/gmarik/Vundle.vim.git ~/.vim/bundle/Vundle.vim 

现在设置你的.vimrc文件
set nocompatible 
filetype off   
set rtp+=~/.vim/bundle/Vundle.vim
call vundle#begin()  
Plugin 'gmarik/Vundle.vim' 
Bundle 'scrooloose/nerdtree'
let NERDTreeWinPos='right'
let NERDTreeWinSize=30
map <F2> :NERDTreeToggle<CR>
call vundle#end()  



:BundleList -列举出列表中(.vimrc中)配置的所有插件
:BundleInstall -安装列表中全部插件
:BundleInstall! -更新列表中全部插件
:BundleSearch foo -查找foo插件
:BundleSearch! foo -刷新foo插件缓存
:BundleClean -清除列表中没有的插件
:BundleClean! -清除列表中没有的插件


""将F2设置为开关NERDTree的快捷键
map <f2> :NERDTreeToggle<cr>
""修改树的显示图标
let g:NERDTreeDirArrowExpandable = '+'
let g:NERDTreeDirArrowCollapsible = '-'
""窗口位置
let g:NERDTreeWinPos='left'
""窗口尺寸
let g:NERDTreeSize=30
""窗口是否显示行号
let g:NERDTreeShowLineNumbers=1
""不显示隐藏文件
let g:NERDTreeHidden=0
""打开vim时如果没有文件自动打开NERDTree
autocmd vimenter * if !argc()|NERDTree|endif
""当NERDTree为剩下的唯一窗口时自动关闭
autocmd bufenter * if (winnr("$") == 1 && exists("b:NERDTree") && b:NERDTree.isTabTree()) | q | endif
""打开vim时自动打开NERDTree
autocmd vimenter * NERDTree</cr></f2>

 Plugin 'gmarik/Vundle.vim' 
 Plugin 'kien/ctrlp.vim' / 搜索      
 Bundle 'scrooloose/nerdtree'
 Bundle 'shawncplus/phpcomplete.vim'
 Plugin 'scrooloose/syntastic' 
