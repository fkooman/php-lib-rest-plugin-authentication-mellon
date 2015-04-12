%global composer_vendor  fkooman
%global composer_project rest-plugin-mellon

%global github_owner     fkooman
%global github_name      php-lib-rest-plugin-mellon

Name:       php-%{composer_vendor}-%{composer_project}
Version:    0.3.1
Release:    1%{?dist}
Summary:    Mellon (SAML) Authentication plugin for fkooman/rest

Group:      System Environment/Libraries
License:    ASL 2.0
URL:        https://github.com/%{github_owner}/%{github_name}
Source0:    https://github.com/%{github_owner}/%{github_name}/archive/%{version}.tar.gz
BuildArch:  noarch

Provides:   php-composer(%{composer_vendor}/%{composer_project}) = %{version}

Requires:   php >= 5.3.3

Requires:   mod_auth_mellon >= 0.7.0

Requires:   php-composer(fkooman/rest) >= 0.8.0
Requires:   php-composer(fkooman/rest) < 0.9.0

%description
Library written in PHP to make it easy to develop REST applications.

%prep
%setup -qn %{github_name}-%{version}

%build

%install
mkdir -p ${RPM_BUILD_ROOT}%{_datadir}/php
cp -pr src/* ${RPM_BUILD_ROOT}%{_datadir}/php

%files
%defattr(-,root,root,-)
%dir %{_datadir}/php/%{composer_vendor}/Rest/Plugin/Mellon
%{_datadir}/php/%{composer_vendor}/Rest/Plugin/Mellon/*
%doc README.md CHANGES.md COPYING composer.json

%changelog
* Sun Apr 12 2015 François Kooman <fkooman@tuxed.net> - 0.3.1-1
- update to 0.3.1

* Wed Mar 11 2015 François Kooman <fkooman@tuxed.net> - 0.3.0-1
- update to 0.3.0

* Sat Feb 07 2015 François Kooman <fkooman@tuxed.net> - 0.2.0-1
- update to 0.2.0

* Sun Oct 26 2014 François Kooman <fkooman@tuxed.net> - 0.1.2-1
- require mod_auth_mellon

* Thu Oct 23 2014 François Kooman <fkooman@tuxed.net> - 0.1.1-1
- update to 0.1.1

* Tue Oct 21 2014 François Kooman <fkooman@tuxed.net> - 0.1.0-1
- initial package
