"use strict ";

import Comment from './Comment';
import ConfirmationDeletion from './ConfirmationDeletion';
import Messages from "./Messages.js";
import Layout from "./Layout.js";
import Offcanvas from './Offcanvas';
import Photo from './Photo';
import Preset from './Preset';
import ResettingFilters from './ResettingFilters';
import Sender from './Sender';
import Spinner from './Spinner';
import Toast from './Toast';
import CookieNotice from "../../vendor/mldanshin/package-cookie-notice/resources/js/CookieNotice.js";

const messages = new Messages();
const layout = new Layout();
const spinner = new Spinner();
const toast = new Toast(messages);
const sender = new Sender(layout, messages, toast);

new CookieNotice();
new Comment(spinner, toast);
new ConfirmationDeletion(messages);
new Offcanvas();
new Preset(sender, toast, spinner);
new Photo(sender, spinner, toast);
new ResettingFilters();
