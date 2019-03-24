/**
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

((Joomla, document) => {
  'use strict';

  const btn = document.getElementById('btn-login-submit');
  const form = document.getElementById('form-login');
  const formTmp = document.querySelector('.login-initial');

  if (btn) {
    btn.addEventListener('click', (event) => {
      event.preventDefault();
      if (form && document.formvalidator.isValid(form)) {
        Joomla.submitbutton('login');
      }
    });
  }

  if (formTmp) {
    formTmp.style.display = 'block';
    if (!document.querySelector('joomla-alert')) {
      document.getElementById('mod-login-username').focus();
    }
  }

  if (form) {
    form.addEventListener('submit', (event) => {
      const segments = [];

      event.preventDefault();
      segments.push('format=json');

      for (let eIndex = 0; eIndex < form.elements.length; eIndex += 1) {
        const element = form.elements[eIndex];

        if (element.hasAttribute('name') && element.nodeName === 'INPUT') {
          segments.push(`${encodeURIComponent(element.name)}=${encodeURIComponent(element.value)}`);
        }
      }

      Joomla.request({
        url: 'index.php',
        method: 'POST',
        data: segments.join('&').replace(/%20/g, '+'),
        perform: true,
        onSuccess: (json) => {
          const response = JSON.parse(json);

          if (typeof response.messages === 'object' && response.messages !== null) {
            Joomla.renderMessages(response.messages);
          }

          if (response.success) {
            Joomla.Event.dispatch(form, 'joomla:login');
            window.location.href = response.data.return;
          }
        },
        onError: (xhr) => {
          Joomla.renderMessages(Joomla.ajaxErrorsMessages(xhr));
        },
      });
    });
  }
})(window.Joomla, document);