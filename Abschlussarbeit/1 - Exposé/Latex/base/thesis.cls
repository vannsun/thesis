% class options:
% - select either [german] or [english]
% - select the type of thesis from:
%   [bachelor, master, generic, diss, expose]
%   (in case of generic, use \type{} to specify it)
%   (dissertation so far in German only)
% - use option "alpha" for abbreviated citation (instead of numbers)
% - option "draft" is available, too
% - use options "utf8" or "latin1" to select inputencoding
% - use option "coffee" for fun
\ProvidesClass{base/thesis}

%% packages
\usepackage[utf8]{inputenc}       % Standard for Linux
%\usepackage[latin1]{inputenc}    % Standard for Windows
\usepackage{ngerman}              % For German language
\usepackage{fancyhdr}
\usepackage{geometry}
\usepackage{ifpdf}
\usepackage{setspace}             % For line spread



% For pdflatex
\ifpdf
  % One of these two:
  \usepackage[pdftex]{graphicx}
  %\usepackage[pdftex]{epsfig}

  \usepackage[pdftex]{hyperref}
% For latex (dvi)
\else
  % One of these two:
  \usepackage[dvips]{graphicx}
  %\usepackage[dvips]{epsfig}

  % make the command \href from hyperref available as a 'print only'
  \newcommand{\href}[2]{#2}
\fi


%% Picture options
\graphicspath{{pictures/}}         % Default path to pictures used
\DeclareGraphicsExtensions{.png}   % More extensions can be added


%% Pagestyle options
\pagestyle{fancy}
%\lhead{}
%\chead{}
%\rhead{}
%\lfoot{Daniel Süpke}
%\cfoot{}
%\rfoot{}
\renewcommand{\headrulewidth}{0.4pt}



\geometry{a4paper,left=3cm,right=3cm}
%\geometry{a4paper,left=3cm,right=2.5cm}   % Please use these settings for a PhD-thesis


\newcommand{\setdraft}{}
\DeclareOption{draft}{\renewcommand{\setdraft}{draft}}

\newcounter{sprache}
\setcounter{sprache}{-1}

\DeclareOption{german}{
  \setcounter{sprache}{1}
  \def\@dept{Department f\"ur Informatik}
  \def\@type{Masterarbeit}
}
\DeclareOption{english}{
  \setcounter{sprache}{2}
  \def\@dept{Institute for Computer Science}
  \def\@type{Master's Thesis}
}

\newcounter{mytype}
\setcounter{mytype}{-1}
\DeclareOption{bachelor}{\setcounter{mytype}{1}}
\DeclareOption{master}{\setcounter{mytype}{2}}
\DeclareOption{generic}{\setcounter{mytype}{0}}
\DeclareOption{diss}{\setcounter{mytype}{3}}

%
\newif\ifexpose\exposefalse
\DeclareOption{expose}{
	\setcounter{mytype}{4}
  	\exposetrue
}

\newcommand{\generatetitle}{
%% Title page
\begin{titlepage}
  \begin{centering}
  \begin{figure}[h!]
    \centering
    \includegraphics[width=310pt]{CvO-Oldenburg-Logo}    % Ggf. Copyright beachten - ansonsten nur für Gebrauch an der CvO
  \end{figure}

  \vspace*{-0.8cm}

  \begin{figure}[h!]
    \centering
    \includegraphics[width=250pt]{VLBA_waagerecht}    % Ggf. Copyright beachten - ansonsten nur für Gebrauch an der CvO/VLBA
  \end{figure}

  \vspace*{0.4cm}
  
  \textsf{\Huge \textbf{Using \LaTeX\ for creating scientific papers at the VLBA Oldenburg\\}}

  \vspace*{0.5cm}
  \noindent Referat / Diplomarbeit\\
  \emph{Bei Referaten noch mit Zusatz:} im Rahmen des..     % Insert correct type

  \end{centering}
  
  \vspace*{1.5cm}
  \begin{tabbing}
  xxxxxxxxxxxxxxxx\= \kill
  
  % Change me
  \small Themensteller:\> Prof. Dr.-Ing. Jorge Marx Gómez\\
  \small Betreuer:\> Titel Vorname Name\\\\

  \small Vorgelegt von: \>Name\\
  \small \>Semesteranschrift\\
  \small \>PLZ Wohnort:\\
  \small \>Telefonnummer:\\
  \small \>mustermann@uni-oldenburg.de\\\\

  \small Abgabetermin:\> 99. Januar 9999
  \end{tabbing}
\end{titlepage}
}